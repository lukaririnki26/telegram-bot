<script>
    $(document).ready(function() {
        /**
         * AJAX Form Submitter
         */
        $('.btn-form-submit').on('click', function(e) {
            e.preventDefault(); // Prevent the default form submission behavior

            var submitButton = $(this); // Reference to the clicked submit button
            var submitForm = $(this).closest('form'); // Find the closest form element
            var formActionUrl = submitForm.data('url'); // Get the form action URL from the 'data-url' attribute
            var formRedirectUrl = submitForm.data('redirect'); // Get the redirect URL from the 'data-redirect' attribute

            // Create a FormData object to handle form data
            let formData = new FormData(submitForm[0]);

            // Make an AJAX POST request
            $.ajax({
                url: formActionUrl,
                type: 'POST',
                data: formData,
                contentType: false, // Disable content type for FormData
                processData: false, // Prevent automatic processing of data
                beforeSend: function() {
                    // Remove previous error states
                    submitForm.find('.is-invalid').removeClass('is-invalid');
                    submitForm.find('.invalid-feedback').remove();

                    // Replace the submit button with a loading spinner
                    submitButton.prop('disabled', true).html(`
                    <span class="spinner-border spinner-border-sm ms-3 btn-loading" role="status">
                        <span class="visually-hidden">@lang('admin.loading')</span>
                    </span>
                `);
                },
                success: function(response) {
                    // Show success toast notification
                    NioApp.Toast(`${response.message}`, 'info', { position: 'top-right' });

                    // Redirect or reload the page based on the presence of a redirect URL
                    if (formRedirectUrl) {
                        setTimeout(() => {
                            window.location.replace(formRedirectUrl);
                        }, 2000);
                    } else {
                        location.reload();
                    }
                },
                error: function(xhr) {
                    // Show error toast notification
                    NioApp.Toast(
                        `Request failed: ${xhr.responseJSON?.message || 'Unknown error'}`,
                        'error', { position: 'top-right' }
                    );

                    // Restore the submit button
                    submitButton.prop('disabled', false).html('Submit');

                    // Display validation errors
                    const $errors = xhr.responseJSON?.errors;
                    if ($errors && typeof $errors === 'object') {
                        Object.entries($errors).forEach(([key, value]) => {
                            const $input = submitForm.find(`[key="${key}"]`); // Find input with the name attribute
                            $input.addClass('is-invalid'); // Mark input as invalid
                            $input.after(`
                            <span class="text-danger invalid-feedback">
                                ${value}
                            </span>
                        `); // Append error message
                        });
                    }
                },
                complete: function() {
                    // Restore the submit button after the request completes
                    submitButton.prop('disabled', false).html('Submit');
                }
            });
        });

        // Listen to the 'input' event on the name field
        $('.input-slug').on('input', function () {
            var nameValue = $(this).val(); // Get the value of the name field

            // Convert the name value to a slug format
            var slugValue = nameValue
                .toLowerCase() // Convert to lowercase
                .trim() // Remove whitespace from both ends
                .replace(/[^\w\s-]/g, '') // Remove all non-word characters except spaces and hyphens
                .replace(/[\s_-]+/g, '-') // Replace spaces and underscores with a single hyphen
                .replace(/^-+|-+$/g, ''); // Remove leading and trailing hyphens

            // Set the value of the slug field
            $('#' + $(this).data('target')).val(slugValue);
        });
    });
</script>