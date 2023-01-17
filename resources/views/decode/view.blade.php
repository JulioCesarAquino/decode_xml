<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decodificador de XML</title>
    <meta name="description" content="" />
    <meta name="author" content="Codeconvey" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('storage/decoder/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/decoder/ui/style.css') }}">
    <!--Only for demo purpose - no need to add.-->
</head>

<body>
    <div class="ScriptTop">
        <div class="rt-container">
            <div class="col-rt-4" id="float-right">
            </div>
        </div>
    </div>
    <header class="ScriptHeader">
        <div class="rt-container">
            <div class="col-rt-12">
                <div class="rt-heading">
                    <h1><small>Importe aqui o XML</small></h1>
                    <p>formatação de xml para json</p>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="rt-container">
            <div class="col-rt-12">
                <div class="Scriptcontent">
                    <form  action="add" id="fupForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="images" class="drop-container">
                        <span class="drop-title">Drop files here</span>
                        <input type="file" id="nota" name="nota[]" accept="xml/*" required multiple>
                    </label>
                    <input type="hidden" id="CdVenda" name="cod_venda">
                    <p><button id="toggle" class="btn-success">Upload!</button></p>
                    </form>
                    <script>
                        // const btn = document.querySelector('#toggle');
                        // btn.addEventListener('click', alertMod);

                        // function alertMod() {
                        //     let foo = prompt('Informe o código da venda.');
                        //     if (foo !== null && foo !== undefined) {
                        //         document.getElementById("CdVenda").value = foo;
                        //         $('#fupForm').submit();
                        //         return true
                        //     } else {
                        //         return false
                        //     }
                        // }
                    </script>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>

</html>
