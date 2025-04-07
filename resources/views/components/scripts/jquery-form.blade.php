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

    /**
     * Form Reset Button
     */
    $('.btn-form-reset').on('click', function () {
        var target = $(this).data('target');
        var form = $('[data-content="' + target + '"]').find('form');
        var formTitle = $(this).data('form-title');

        $('[data-content="form-title"]').text(formTitle);

        var dataForm = $('#' + $(this).data('target'));
        var input = dataForm.find('[type="file"]');
        if (input.attr('type') === 'file') {
            input.addClass('dropify');
            input.attr('data-default-file', '');
            input.dropify();

        }

        if (form.length > 0) {
            form[0].reset();
        } else {
            console.warn('Form not found for target:', target);
        }
    });

    /**
     * Rightbar Form Edit Button
     */
    $('.btn-action-sidebar-edit').on('click', function () {
        var dataUrl = $(this).data('url');
        var dataForm = $('#' + $(this).data('target'));

        var formTitle = $(this).data('form-title');

        $('[data-content="form-title"]').text(formTitle);

        $.ajax({
            url: dataUrl,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                var formData = response.data;

                $.each(formData, function (key, value) {
                    var input = dataForm.find('[key="' + key + '"]');

                    if (input.length > 0) {

                        dataForm.find('.js-select2').select2('destroy').select2();
                        if (input.attr('type') === 'file') {
                            input.addClass('dropify');
                            input.attr('data-default-file', value);
                            input.dropify();
                        }
                        if (input.attr('type') !== 'file') {
                            input.val(value);
                        }
                        if (input.attr('type') !== 'file' && input.hasClass('select2')){
                            if (input.find('option[value="' + value.id + '"]').length === 0) {
                                input.append(new Option(value.name, value.id));
                            }
                            input.val(value.id).trigger('change');
                        }
                        if (input.attr('type') !== 'file' && input.hasClass('custom-control-group')) {
                            input.find('input[type="radio"]').each(function () {
                                const isMatch = $(this).val() == value;
                                $(this)
                                    .prop('checked', isMatch)
                                    .toggleClass('checked', isMatch)
                                    .parent('.custom-control.custom-radio')
                                    .toggleClass('checked', isMatch);
                            });
                        }

                    } else {
                        console.warn('No input found for key:', key);
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    });

const observer = new MutationObserver(function (mutationsList, observer) {
    if ($('.toggle-overlay').length === 0) {
        $('[type="file"].dropify').each(function () {
            var input = $(this);
            var originalInput = input.clone();
            originalInput.removeClass('dropify')
                         .attr('data-default-file', '')
                         .val('');
            input.closest('.dropify-wrapper').replaceWith(originalInput);
        });
    }
});

observer.observe(document.body, { childList: true, subtree: true });

</script>
