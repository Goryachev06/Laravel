<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Столицы мира</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ mix('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark custom-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3">
                <div class="d-flex justify-content-center align-items-center bg-white text-dark" 
                     style="width: 50px; height: 50px; font-size: 30px; font-weight: bold;">C</div>
                <span class="fs-4 fw-bold">Столицы мира</span>
            </a>
            <a href="{{ route('capitals.create') }}" class="btn btn-outline-light">Добавить</a>
        </div>
    </nav>

    <div class="container mt-5">
        @if(session('success'))
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">
                <div id="successToast" class="toast" role="alert">
                    <div class="toast-header bg-success text-white">
                        <strong class="me-auto">
                            <i class="fas fa-check-circle me-1"></i> Успешно
                        </strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <h1 class="mb-5 fw-bold">Заголовок первого уровня</h1>
        <div class="row g-4">
            @foreach($capitals as $capital)
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="card h-100 custom-card">
                        <img src="{{ asset('storage/' . $capital->photo) }}" 
                             class="card-img-top" 
                             alt="{{ $capital->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $capital->name }}</h5>
                            <p class="card-text flex-grow-1">{{ $capital->short_info }}</p>
                            <div class="d-flex gap-2 mt-auto">
                                <a href="{{ route('capitals.show', $capital) }}" 
                                   class="btn btn-primary w-100">Читать далее</a>
                                <a href="{{ route('capitals.edit', $capital) }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('capitals.destroy', $capital) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Удалить столицу?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="bg-white mt-5 py-3">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <h5 class="m-0">Горячев Григорий Алексеевич</h5>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-dark rounded-3 load-toast-trigger">VK</button>
                <button type="button" class="btn btn-sm btn-outline-dark rounded-3 load-toast-trigger">TG</button>
                <button type="button" class="btn btn-sm btn-outline-dark rounded-3 load-toast-trigger">YDX</button>
            </div>
        </div>
    </footer>

    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
        <div id="unavailableToast" class="toast" role="alert">
            <div class="toast-header">
                <i class="fas fa-circle-notch fa-spin-custom me-2 text-primary"></i>
                <strong class="me-auto">Информация</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                На текущий момент этот функционал недоступен.
            </div>
        </div>
    </div>

    <script src="{{ mix('js/main.js') }}"></script>
</body>
</html>