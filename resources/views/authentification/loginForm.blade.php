<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Lien vers le fichier CSS de Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color:white 
            color: white;
        }
        .login-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            padding: 2rem;
            background-color:rgb(235, 232, 229);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .logo-left {
            position: absolute;
            top: 15px;
            left: 15px;
        }
        .logo-right {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        .btn-custom:hover {
            background-color: #9b1b30; /* Rouge plus foncé pour l'effet hover */
        }
        label {
            color: #333; /* Couleur foncée pour les labels */
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%; /* Les champs de saisie prennent toute la largeur disponible */
            padding: 10px;
            margin-bottom: 15px; /* Ajoute un espace entre les champs */
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        input[type="checkbox"]:checked {
            background-color: #9b1b30; /* Changer la couleur des cases à cocher */
        }
        .form-check-label {
            color: #333;
            display: inline-block;
            margin-left: 5px;
        }
        input[type="password"], input[type="text"], input[type="email"] {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo à gauche -->
        <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="logo-left" width="120">
        
        <!-- Logo à droite -->
        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="logo-right" width="150">

        <!-- Card de connexion -->
         <br><br><br>
        <div class="login-card">
            <h3 class="text-center mb-4">Connexion</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('utilisateur.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="login" name="login" id="login" class="form-control" placeholder="nom.prenom@parlement.com" value="{{ old('login') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="***********" class="form-control" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" id="showPassword" class="form-check-input">
                    <label class="form-check-label" for="showPassword">Afficher le mot de passe</label>
                </div>

                <button type="submit" class="btn btn-danger btn-lg btn-block">Se connecter</button>
            </form>
        </div>
    </div>

    <script>
        // Script pour afficher/masquer le mot de passe
        document.getElementById('showPassword').addEventListener('change', function () {
            const passwordField = document.getElementById('password');
            passwordField.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>
