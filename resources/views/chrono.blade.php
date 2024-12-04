<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculté de Pharmacie de l'ULB : Electronic Notebooks (ADMIN)</title>
    <link rel="stylesheet" href="<?= asset('css/styles.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/chrono.css') ?>">
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclure Bootbox.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootbox@5.5.2/bootbox.min.js"></script>
    <!-- Inclure SweetAlert2 depuis un CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

    <div class="form-container">
        <form action="{{ url('/call_form_after') }}" method="POST">
        @csrf
            <div class="title-section">
                <img src="<?= asset('images/Logo-Pharmacie-ULB.png') ?>" alt="Logo ULB">
                <h1>Electronic Notebooks : operation in progress</h1>
            </div>

            <div class="warning-box">
                Operation in progress by David Dubois, please do not touch this computer.
            </div>

            
            <!-- Chronomètre -->
            <div id="timer" style="font-size: 24px; font-weight: bold; text-align: center;">00:00:00</div>
            <input type="hidden" id="manipulation_time" name="manipulation_time" value="">


            <div>
            <button id="call_form_after" type="submit" class="btn btn-primary">
                                    The manipulation is complete
                </button>
            </div>

        </form>

        

        <script>
            let seconds = 0;
            let timerInterval;

            function startTimer() 
            {
                timerInterval = setInterval(function () {
                    seconds++;
                    let hrs = Math.floor(seconds / 3600);
                    let mins = Math.floor((seconds % 3600) / 60);
                    let secs = seconds % 60;

                    // Formater pour afficher 2 chiffres
                    hrs = hrs < 10 ? '0' + hrs : hrs;
                    mins = mins < 10 ? '0' + mins : mins;
                    secs = secs < 10 ? '0' + secs : secs;

                    document.getElementById('timer').textContent = `${hrs}:${mins}:${secs}`;
                    document.getElementById('manipulation_time').value = seconds; // Stocker les secondes écoulées
                }, 1000);
            }

    // Lancer le chronomètre dès que la page est chargée
    window.onload = startTimer;
</script>





        
</body>
</html>
