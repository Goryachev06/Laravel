<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить столицу</title>
    <link href="{{ mix('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Добавить столицу</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('capitals.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @include('capitals._form', ['submitText' => 'Добавить'])
                </form>
            </div>
        </div>
    </div>
</body>
</html>