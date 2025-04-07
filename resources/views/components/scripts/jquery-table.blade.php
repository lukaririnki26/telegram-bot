<script>
    /**
     * Table Filter: Filters table rows based on user input
     */
    $('.input-filter').on('input', function () {
        // Get the value of the filter input
        var filterText = $(this).val().toUpperCase().trim();

        // Iterate through each table row item
        $('.table-row-item').each(function () {
            var rowText = $(this).text().toUpperCase().trim(); // Get the text content of the row

            // Check if the filter text exists in the row text
            if (rowText.indexOf(filterText) !== -1) {
                $(this).show(); // Show the row if it matches the filter
            } else {
                $(this).hide(); // Hide the row if it doesn't match the filter
            }
        });
    });

    $(document).ready(function () {
        // Select all checkboxes
        $('#table-select-all').on('change', function () {
            var isChecked = $(this).is(':checked'); // Check if Select All is checked
            $('.table-row-item .custom-control-input').prop('checked', isChecked); // Set all checkboxes to match Select All
        });

        // Collect selected IDs and trigger remove action
        $('.btn-remove-selected').on('click', function (e) {
            var removeActionUrl = $(this).data('url');

            e.preventDefault();

            // Collect IDs from checked checkboxes
            var selectedIds = [];
            $('.table-row-item .custom-control-input:checked').each(function () {
                selectedIds.push($(this).data('id'));
            });

            if (selectedIds.length === 0) {
                alert('@lang('admin.no_items_selected_for_removal')');
                return;
            }

            // Confirm action
            if (!confirm('@lang('admin.are_you_sure_you_want_to_remove_the_selected_items')')) {
                return;
            }

            // Perform AJAX request to remove items
            $.ajax({
                url: removeActionUrl, // Replace with your delete endpoint
                type: 'POST',
                data: {
                    ids: selectedIds, // Pass selected IDs to the server
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    // Show success message and reload table
                    alert(response.message || 'Selected items were removed successfully.');
                    location.reload();
                },
                error: function (xhr) {
                    // Show error message
                    alert(xhr.responseJSON?.message || 'Failed to remove selected items.');
                }
            });
        });
    });

    /**
     * Table Delete Button
     */
    $('.btn-action-delete').on("click", function(e) {
        e.preventDefault();

        var dataLabel = $(this).data('label');

        Swal.fire({
            title: '@lang('admin.are_you_sure_you_want_to_delete')' + ' ' + dataLabel + '?',
            text: "@lang('admin.you_wont_be_able_to_revert_this')",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '@lang('admin.yes_delete_it')'
        }).then((result) => {
            if (result.isConfirmed) {
                var actionUrl = $(this).data('url');

                var token = "{{ csrf_token() }}";
                $.ajax({
                    type: 'POST',
                    url: actionUrl,
                    data: {
                        '_token': token,
                        '_method': 'DELETE'
                    },
                    success: function(response) {
                        location.reload();
                        Swal.fire({
                            title: '@lang('admin.deleted')!',
                            text: '@lang('admin.successful_delete_label')' + ': ' + dataLabel,
                            icon: 'Success',
                            timer: 2000,
                            timerProgressBar: true,
                        })
                    }
                });
            }
        });
    });
</script>
