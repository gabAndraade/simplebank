<?php

$config = parse_ini_file('.env');

$servername = $config['DB_HOST'];
$username = $config['DB_USER'];
$password = $config['DB_PASS'];
$dbname = $config['DB_NAME'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

 
    $stmt = $conn->prepare("SELECT nome, cpf, data_nascimento, avatar FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($nome, $cpf, $dataNascimento, $avatar);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "ID do usuário não fornecido.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e9d2580056.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="src/css/styles.css">
    <title>SimpleBank</title>
</head>
<body>
    <header class="header">
        <nav class="nav-bar">
            <div class="nav-logo">
                <i class="fa-solid fa-building-columns">SimpleBank</i>
            </div>
            <ul class="nav-list">
                <li><a href="#home" class="links">Conta Digital</a></li>
                <li><a href="#investments" class="links">Investimentos</a></li>
                <li><a href="#benefits" class="links">Vantagens</a></li>
                <li><a href="#services" class="links">Serviços</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="home" id="home">
            <div class="home-container">
                <div class="card-container">
                    <div class="card">
                        <div class="card-front">
                            <div class="card-logo">SimpleBank</div>
                            <div class="card-number" id="card-number">2352 5678 9012 3456</div>
                            <div class="card-info">
                                <div class="card-holder">
                                    <span>Nome do Titular</span>
                                    <strong id="card-holder"><?php echo $nome; ?></strong>
                                </div>
                                <div class="card-expiry">
                                    <span>Validade</span>
                                    <strong id="card-expiry">12/28</strong>
                                </div>
                            </div>
                        </div>
                        <div class="card-back">
                            <div class="cvv-container">
                                <span>CVV</span>
                                <strong>592</strong>
                            </div>
                            <div class="stripe"></div>
                        </div>                    
                    </div>
                </div>
                <div class="saldo-container">
                    <h3>Saldo</h3>
                    <h1><span>R$ </span>0,00</h1>
                    <button class="btn-default pix">
                        <i class="fa-brands fa-pix"></i>
                        <h4>PIX</h4>
                    </button>
                    <button class="btn-default extrato">
                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        <h4>EXTRATO</h4>
                    </button>
                    <button class="btn-default investir">
                        <i class="fa-solid fa-chart-line"></i>
                        <h4>INVESTIR</h4>
                    </button>
                </div>
                <div class="perfil-container">
                    <div class="perfil-img">
                        <img id="profile-image" src="uploads/<?php echo $avatar; ?>" alt="image" width="200px">
                    </div>
                    <div class="perfil-info">
                        <h1 id="profile-first-name"><?php echo explode(' ', $nome)[0]; ?></h1>
                        <h3 id="profile-last-name"><?php echo implode(' ', array_slice(explode(' ', $nome), 1)); ?></h3>
                    </div>
                    <div class="perfil-config">
                        <h1>Configurações</h1>
                        <h1>Informações</h1>
                        <h1>Benefícios</h1>
                        <h1><span><i class="fa-solid fa-right-from-bracket"></i>Logout</span></h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="investments" id="investments">
            <div class="investment-header">
                <h1>Investi<span>mentos</span></h1>
                <p>Conheça nossas opções e invista com segurança</p>
            </div>
            <div class="investment-options">
                <div class="investment-option">
                    <div class="investment-info">
                        <h2>Fundos</h2>
                        <p>Conheça nossos fundos de investimento.</p>
                        <a href="#" class="button">Ver fundos</a>
                    </div>
                    <img src="src/images/austin-distel-DfjJMVhwH_8-unsplash.jpg" alt="Fundos de Investimento">
                </div>
                <div class="investment-option">
                    <div class="investment-info">
                        <h2>Tesouro Direto</h2>
                        <p>Invista no Tesouro Direto de forma simples e segura.</p>
                        <a href="#" class="button">Ver opções</a>
                    </div>
                    <img src="src/images/towfiqu-barbhuiya-jpqyfK7GB4w-unsplash.jpg" alt="Tesouro Direto">
                </div>
                <div class="investment-option">
                    <div class="investment-info">
                        <h2>Renda Fixa</h2>
                        <p>Invista em produtos de Renda Fixa com alta rentabilidade.</p>
                        <a href="#" class="button">Ver produtos</a>
                    </div>
                    <img src="src/images/dylan-calluy-JpflvzEl5cg-unsplash.jpg" alt="Renda Fixa">
                </div>
            </div>
        </section>
        <section class="benefits-section" id="benefits">
            <div class="container">
                <h2>Vantagens de ter</h2>
                <h1>Cartão SimpleBank</h1>
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        <h3>Cashback em Compras</h3>
                        <p>Receba até 5% de volta em todas as suas compras feitas com o Cartão SimpleBank.</p>
                    </div>
                    <div class="benefit-item">
                        <i class="fa-solid fa-lock"></i>
                        <h3>Segurança Avançada</h3>
                        <p>Desfrute de tecnologia de segurança de ponta para proteger suas transações.</p>
                    </div>
                    <div class="benefit-item">
                        <i class="fa-solid fa-plane-up"></i>
                        <h3>Benefícios em Viagens</h3>
                        <p>Aproveite acesso a salas VIP em aeroportos e seguros de viagem gratuitos.</p>
                    </div>
                    <div class="benefit-item">
                        <i class="fa-solid fa-gift"></i>
                        <h3>Programa de Recompensas</h3>
                        <p>Acumule pontos e troque por produtos, viagens e muito mais.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="services-section" id="services">
            <div class="container">
                <h2>Nossos <span>Serviços</span></h2>
                <div class="services-grid">
                    <div class="service-item">
                        <i class="fas fa-university"></i>
                        <h3>Conta Corrente</h3>
                        <p>Abra uma conta corrente gratuita e gerencie suas finanças facilmente.</p>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-credit-card"></i>
                        <h3>Cartões de Crédito</h4>
                        <p>Escolha entre uma variedade de cartões de crédito com benefícios exclusivos.</p>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-mobile-alt"></i>
                        <h3>Aplicativo Móvel</h3>
                        <p>Faça transações bancárias e gerencie sua conta em qualquer lugar com nosso aplicativo móvel.</p>
                    </div>
                    <div class="service-item">
                        <i class="fas fa-lock"></i>
                        <h3>Segurança</h3>
                        <p>Contamos com a mais avançada tecnologia de segurança para proteger seus dados.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <i class="fa-solid fa-building-columns">SimpleBank</i>
            </div>
            <ul class="footer-list">
                <li><a href="#home" class="links">Conta Digital</a></li>
                <li><a href="#investments" class="links">Investimentos</a></li>
                <li><a href="#benefits" class="links">Vantagens</a></li>
                <li><a href="#services" class="links">Serviços</a></li>
            </ul>
        </div>
    </footer>
    <script src="src/javascript/script.js"></script>
</body>
</html>
