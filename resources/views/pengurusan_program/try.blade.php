<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/assets/plugins/custom/datatables/datatables.bundle.css')">
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/css/style.bundle.css">
    <link rel="stylesheet" href="/assets/css/customAADK.css">
</head>
<body>

<h2>Modal Example</h2>

<!-- Input field to enter program ID -->
<input type="text" id="programId" placeholder="Enter Program ID" value="1">
<button id="openModalBtn">Open Modal</button>

<!-- The Modal -->
<div id="exampleModalScrollable" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalBody">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
        var modal = $('#exampleModalScrollable');
        var span = $('.close');
        var modalBody = $('#modalBody');
        var openModalBtn = $('#openModalBtn');
        var programIdInput = $('#programId'); // Input field for program ID

        // When the user clicks on the button, open the modal
        openModalBtn.on('click', function() {
            var programId = programIdInput.val(); // Get the ID from the input field

            if (programId) {
                // Load content from a Laravel route with the ID
                modalBody.load('/model/' + programId, function() {
                    modal.show(); // Show the modal
                });
            } else {
                alert('Please enter a program ID.');
            }
        });

        // When the user clicks on <span> (x), close the modal
        span.on('click', function() {
            modal.hide(); // Hide the modal
        });

        // When the user clicks anywhere outside of the modal, close it
        $(window).on('click', function(event) {
            if ($(event.target).is(modal)) {
                modal.hide(); // Hide the modal
            }
        });
    });
</script>

</body>
</html>
