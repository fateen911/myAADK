<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <title>Programs Slideshow</title>
</head>
<body>
<div class="container mt-5 landing-red rounded-3">
    <div id="programCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" id="carousel-content">
            <!-- Dynamic program content will be inserted here -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#programCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#programCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to format date in d/m/Y, h:iA format
        function formatDate(dateStr) {
            const options = {
                year: 'numeric', month: '2-digit', day: '2-digit',
                hour: '2-digit', minute: '2-digit', hour12: true
            };
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-GB', options);
        }

        // Fetch programs with AJAX
        $.ajax({
            url: '/program-dianjurkan',
            method: 'GET',
            success: function (data) {
                let carouselContent = '';
                $.each(data, function (index, program) {
                    carouselContent += `
                        <div class="carousel-item ${index === 0 ? 'active' : ''}">
                            <div class="d-block m-5 w-90 text-center p-5 bg-warning text-black">
                                <h3>${program.nama}</h3>
                                <p>Tarikh/Masa Mula: ${formatDate(program.tarikh_mula)}</p>
                                <p>Tarikh/Masa Tamat: ${formatDate(program.tarikh_tamat)}</p>
                                <p>Tempat: ${program.tempat}</p>
                                <p>Pautan: <a href="${program.pautan_perekodan}">${program.pautan_perekodan}</a></p>
                            </div>
                        </div>
                    `;
                });
                $('#carousel-content').html(carouselContent);
            }
        });
    });
</script>
</body>
</html>
