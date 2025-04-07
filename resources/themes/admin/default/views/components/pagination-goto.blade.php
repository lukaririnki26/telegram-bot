@if ($paginator->hasPages())
    <div>Page</div>
    <div>
        <select class="form-select js-select2" data-search="on" data-dropdown="xs center" onchange="location = this.value;">
            @foreach (range(1, $paginator->lastPage()) as $page)
                <option value="{{ $paginator->url($page) }}" {{ $page == $paginator->currentPage() ? 'selected' : '' }}>
                    {{ $page }}
                </option>
            @endforeach
        </select>
    </div>
    <div>OF {{ $paginator->lastPage() }}</div>

    <script>
        document.querySelectorAll('.js-select2').forEach(function (select) {
            select.addEventListener('change', function () {
                window.location.href = this.value;
            });
        });
    </script>
@endif
