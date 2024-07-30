<!DOCTYPE html>
<html>
<head>
    <title>Modal Example</title>
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Modal Example</h2>

<!-- Input field to enter program ID -->
<input type="text" id="programId" placeholder="Enter Program ID">
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
