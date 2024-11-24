jQuery(document).ready(function ($) {
    $(".delete-post-button").on("click", function (e) {
        e.preventDefault();
        const areYouSure = confirm(blogData.deleteConfirmation);
        if (areYouSure) {
            $(this).closest("form").submit();
        }
    });
});
