<?php

namespace App\Http\Controllers\Admin\Settings\Bot;

use App\Models\Bot;
use App\Models\BotState;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\Admin\BotStateResource;
use App\Http\Controllers\Admin\AdminController;

/**
 * Admin BotState Controller
 */
class BotStateController extends AdminController
{
    /**
     * Display a listing of the taxonomies.
     */
    public function index(int $bot_id)
    {
        $bot = Bot::findOrFail($bot_id);
        $states = BotState::query()
            ->where('bot_id', $bot_id)
            ->paginate(25);

        return view('bots.states.index', compact('bot', 'states'));
    }

    /**
     * Show the form for creating or editing a state.
     */
    public function show(int $id)
    {
        $state = BotState::findOrFail($id);

        return new BotStateResource($state);
    }
    
    private function checkStateCommand(string $command, Bot $bot){
        return $bot->states()->where('command', $command)->exists();
    }
    /**
     * Store or update a state.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'username' => [
                'required',
                Rule::unique('states', 'username')->ignore($request->id)
            ],
            'token' => [
                'required',
                Rule::unique('states', 'token')->ignore($request->id)
            ]
        ]);

        if($this->checkStateCommand($command, $bot)){
            if($request->expectsJson()){
                return response()->json(['message' => 'Command telah digunakan'], 403);
            }
            return redirect()->route('settings.bots.states.index')
                ->with('error', 'Command telah digunakan');
        }
        
        $state = BotState::updateOrCreate(
            ['id' => $request->id],
            [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'username' => $request->username,
            'token' => $request->token
            ]
        );

        $message = $request->id == null ? 'created' : 'updated';

        if($request->expectsJson()){
            return response()->json([
                'message'  => "Success store $message state: " . $state->name
            ]);
        }

        return redirect()->route('settings.bots.states.index')
            ->with('success', "Success store $message state: " . $state->name);
    }

    /**
     * Delete a state.
     */
    public function delete(int $id)
    {

        $state = BotState::find($id);

        if (!$state) {
            return redirect()->route('settings.bots.states.index')
                ->with('failed', 'Tag not found.');
        }

        if ($state->delete()) {
            return redirect()->route('settings.bots.states.index')
                ->with('success', 'Success delete state: ' . $state->title);
        }

        return redirect()->route('posts.index')
            ->with('failed', 'Failed delete state: ' . $state->title);
    }

    /**
     * Remove selected taxonomies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeSelected(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:sys_taxonomies,id',
        ]);

        try {
            BotState::whereIn('id', $request->ids)->delete();

            return response()->json([
                'message' => 'Selected states removed successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while removing selected states.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

