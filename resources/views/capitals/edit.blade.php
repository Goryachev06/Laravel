<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать: {{ $capital->name }}</title>
    <link href="{{ mix('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Редактировать: {{ $capital->name }}</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('capitals.update', $capital) }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @include('capitals._form', ['submitText' => 'Обновить'])
                </form>
            </div>
        </div>
    </div>
</body>
</html>