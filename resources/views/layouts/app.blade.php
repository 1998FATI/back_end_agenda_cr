<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
    
html, body {
    direction: rtl; /* Définit la direction du texte et du scroll de droite à gauche */
    unicode-bidi: embed; /* Assure le respect du sens */
    font-family: 'Arial', sans-serif;
    background-color:rgb(235, 239, 239);
    
}


header {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar {
    background-color:rgb(145, 3, 1); 
}

.navbar-brand, .nav-link {
    font-weight: bold;
}

.nav-link:hover {
    color: #FFD700; 
}
.nav-link {
    text-decoration: none; 
    position: relative;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: #FFD700; /* Couleur de la bordure ou du soulignement */
    transition: width 0.3s ease; /* Animation de l'effet */
}

.nav-link:hover::after {
    width: 100%; 
}

.bg-secondary {
    background-color: #595959;
}

.table thead {
    background-color: #003366;
    color: white;
}

.btn-outline-primary {
    border-color: #003366;
    color: #003366;
}

.btn-outline-primary:hover {
    background-color:rgb(11, 108, 205);
    color: white;
}

.btn-outline-danger {
    border-color:rgb(249, 67, 67);
    color:rgb(241, 36, 36);
}

.btn-outline-danger:hover {
    background-color: #cc0000;
    color: white;
}
.pagination .justify-between {
        display: none;
    }
    .dark-mode {
    background-color: #121212;
    color: #ffffff;
}

.dark-mode .navbar {
    background-color: #222222 !important;
}

.dark-mode .table {
    background-color: #1e1e1e;
    color: #ffffff;
}

.dark-mode .table thead {
    background-color: #333333;
}

.dark-mode .btn-outline-light {
    border-color: #ffffff;
    color: #ffffff;
}

.dark-mode .btn-outline-light:hover {
    background-color: #ffffff;
    color: #000000;
}

    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <header class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid d-flex justify-content-between">
        
        <!-- Titre et navigation à gauche -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand mx-3" href="{{ route('dashboard') }}">أجندة المجلس</a>
            <nav class="navbar-nav d-flex flex-row">
                <a class="nav-link mx-2" href="{{ route('reunions.list') }}">الاجتماعات</a>
                <a class="nav-link mx-2" href="{{ route('organs.list') }}">اللجان</a>
                <a class="nav-link mx-2" href="{{ route('lois.list') }}">تحيين النصوص القانونية</a>

                <button id="modeToggle" class="btn btn-outline-light mx-2"
                style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-moon" style="font-size: 0.8rem;"></i>
                </button>
            </nav>
        </div>

        <!-- Bouton utilisateur à droite -->
        <div>
            <button class="btn btn-sm btn-outline-warning dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->prenom }} {{ Auth::user()->name}}
            </button>
            <ul class="dropdown-menu p-0 border-0 shadow-sm" aria-labelledby="userDropdown">
                <li>
                    <form id="logout-form" action="{{ route('utilisateur.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item btn btn-sm btn-outline-secondary w-100 text-start">
                            خروج
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</header>
    <!-- Contenu principal -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const modeToggle = document.getElementById("modeToggle");
        const body = document.body;

        // Vérifier si le mode dark est déjà activé (sauvegardé dans localStorage)
        if (localStorage.getItem("darkMode") === "enabled") {
            body.classList.add("dark-mode");
            modeToggle.innerHTML = '<i class="bi bi-sun"></i> ';
            modeToggle.classList.replace("btn-outline-light", "btn-outline-dark");
        }

        modeToggle.addEventListener("click", function () {
            if (body.classList.contains("dark-mode")) {
                body.classList.remove("dark-mode");
                localStorage.setItem("darkMode", "disabled");
                modeToggle.innerHTML = '<i class="bi bi-moon"></i>  ';
                modeToggle.classList.replace("btn-outline-dark", "btn-outline-light");
            } else {
                body.classList.add("dark-mode");
                localStorage.setItem("darkMode", "enabled");
                modeToggle.innerHTML = '<i class="bi bi-sun"></i>  ';
                modeToggle.classList.replace("btn-outline-light", "btn-outline-dark");
            }
        });
    });
</script>
</body>
</html>
