<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $capital->name }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ mix('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark custom-navbar">
        <div class="container">
            <a href="{{ route('capitals.index') }}" class="navbar-brand text-white">
                <i class="fas fa-arrow-left me-2"></i> Назад
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="modal show d-block position-static" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $capital->name }}</h5>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $capital->photo) }}" 
                             class="img-fluid rounded mb-3" 
                             alt="{{ $capital->name }}">
                        <p>{{ $capital->detailed_info }}</p>
                        <small class="text-muted">
                            Создано: {{ $capital->created_at }} 
                            Обновлено: {{ $capital->updated_at }}
                        </small>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('capitals.edit', $capital) }}" class="btn btn-warning">Редактировать</a>
                        <a href="{{ route('capitals.index') }}" class="btn btn-secondary">Закрыть</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/main.js') }}"></script>
</body>
</html>