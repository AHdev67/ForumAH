<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta name="description" content="<?= $meta_description ?>"> -->
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="https://kit.fontawesome.com/b28c0a82b5.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
        <title>BTT</title>
    </head>

    <body class="d-flex flex-column h-100">

        <header>
            <!-- Fixed navbar -->
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark mb-5">
                <div class="container-fluid">

                    <a class="navbar-brand" href="index.php?ctrl=home&action=index">BINGUS TECH TIPS</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php?ctrl=forum&action=index">Categories</a>
                            </li>

                            <?php
                            if(App\Session::isAdmin()){ ?>
                                <li>
                                    <a class="nav-link" aria-current="page" href="index.php?ctrl=security&action=users">User list</a>
                                </li>
                            <?php } ?>

                        </ul>

                        <div class="d-flex">
                            <?php
                            // si l'utilisateur est connecté 
                            if(App\Session::getUser()){ ?>

                                <a href="index.php?ctrl=security&action=profile">
                                    <button type="button" class="btn btn-outline-light me-2">
                                        <span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?>
                                    </button>
                                </a>

                                <a href="index.php?ctrl=security&action=logout">
                                    <button type="button" class="btn btn-outline-light me-2">Log out</button>
                                </a>

                            <?php }
                            else{ ?>

                                <a href="index.php?ctrl=security&action=displayLogin">
                                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                                </a>

                                <a href="index.php?ctrl=security&action=displayRegister">
                                    <button type="button" class="btn btn-warning">Sign-up</button>
                                </a>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Begin page content -->
        <main class="flex-shrink-0" id="forum">
            <div class="container mt-3 pb-5">
                <?= $page ?>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer mt-auto py-3 bg-body-tertiary">
            <div class="container">
                <span class="text-body-secondary">
                    <p>&copy; <?= date_create("now")->format("Y") ?> - <a href="#">Règlement du forum</a> - <a href="#">Mentions légales</a></p>
                </span>
            </div>
        </footer>

    

        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous">
        </script>

        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>

    </body>
</html>