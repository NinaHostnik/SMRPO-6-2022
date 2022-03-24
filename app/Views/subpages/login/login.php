<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SMRPO</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="<?php echo "/styles/style.css"; ?>">
    <link rel="stylesheet" href="<?php echo "/styles/login.css"; ?>">
</head>
<body>

<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <h4 class="mt-1 mb-5 pb-1"><b>SMRPO</b></h4>
                                </div>

                                <form action="/" method="post">
                                    <p>Prosim vpišite se z uporabniškim računom</p>

                                    <!-- Username -->
                                    <?php echo view("partials/formInput", ['label'=>'Uporabniško ime', "id"=>"username", 'type'=>'text', 'value'=>'']) ?>

                                    <!-- Password -->
                                    <?php echo view("partials/passwordInput", ['label'=>'Geslo', "id"=>"password", 'type'=>'password','value'=>'']) ?>

                                    <!-- Button -->
                                    <?php echo view("partials/formButton", ['name'=>'Prijava']) ?>
                                    <!--<div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary col-12 fa-lg gradient-custom-2 mb-3" type="submit">Prijava</button>
                                    </div>-->

                                    <?php if(uri_string() == "subpages/ustvarjanjeUporabnika/userCreate"){} ?>
                                </form>
                                <?php
                                if (isset($validation)){
                                    echo $validation->listErrors();
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">Nimate uporabniškega računa?</h4>
                                <p class="small mb-0">Uporabniške račune lahko dodeli le admin organizacije. Če uporabniškega računa nimate, prosim govorite s projektno vodjo ali adminom vaše organizacije.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>