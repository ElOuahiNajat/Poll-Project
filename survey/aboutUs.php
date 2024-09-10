<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="icon" type="image/png" href="ocpImg.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            border: none;
            outline: none;
            scroll-behavior: smooth;
            font-family: "Poppins", sans-serif;
        }

        :root {
            --bg-color: black;
            --text-color: white;
            --main-color: #76FF7A;
            --second-bg-color: #333; /* Added for the about section */
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
        }

        body {
            background: var(--bg-color);
            color: var(--text-color);
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 3rem 9%;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
        }

        .logo img {
        width: 150px; /* Ajustez la largeur du logo ici */
        height: auto;
        border-radius: 50%; /* Conserve les proportions de l'image */
         }


        .logo:hover {
            transform: scale(1.1);
        }

        .navbar {
            display: flex;
            align-items: center;
            position: relative;
        }

        .navbar a {
            font-size: 1.8rem;
            color: white;
            margin-left: 4rem;
            font-weight: 500;
            transition: 0.3s ease-in-out;
            border-bottom: 3px solid transparent;
        }

        .navbar a:hover,
        .navbar a.active {
            color: var(--second-bg-color);
            border-bottom: 3px solid var(--main-color);
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--second-bg-color);
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            top: 100%;
            left: 0;
            border-radius: 0.8rem;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 1.6rem;
        }

        .dropdown-content a:hover {
            background-color: var(--main-color);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        #menu-icon {
            display: none; /* Hides the menu icon */
        }

        section {
            
            min-height: 100vh;
            padding: 10rem 9% 5rem;
        }

        .home {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 2rem;
        }

        .home-img img {
            width: 50rem;
            height: 25rem;
            border-radius: 2%;
            /* box-shadow: 0 0 25px var(--main-color); */
            cursor: pointer;
            transition: 0.4s ease-in-out;
        }

        .home-img img:hover {
            box-shadow: 0 0 50px var(--main-color), 0 0 100px var(--main-color);
        }

        .home-content h1 {
            font-size: 4rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .home-content h3 {
            font-size: 2.5rem;
            margin: 1rem 0;
        }

        .home-content p {
            font-size: 1.6rem;
            margin-bottom: 2rem;
        }

        .social-icons {
            margin-bottom: 2rem;
        }

        .social-icons a {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 4.5rem;
            height: 4.5rem;
            background: transparent;
            border: 0.2rem solid var(--main-color);
            font-size: 2.5rem;
            border-radius: 50%;
            color: var(--main-color);
            margin: 3rem 1.5rem 3rem 0;
            transition: 0.3s ease-in-out;
        }

        .social-icons a:hover {
            color: white;
            transform: scale(1.3) translateY(-5px);
            box-shadow: 0 0 25px var(--main-color);
            background-color: var(--main-color);
        }

        .btn {
            display: inline-block;
            padding: 1rem 2.8rem;
            background-color: var(--main-color);
            color: var(--bg-color);
            border-radius: 4rem;
            font-size: 1.6rem;
            color: white;
            border: 2px solid transparent;
            letter-spacing: 0.1rem;
            font-weight: 500;
            transition: 0.3s ease-in-out;
            cursor: pointer;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px var(--main-color);
        }

        .text-animation {
            font-size: 3.4rem;
            font-weight: 600;
            min-width: 28rem;
        }

        .text-animation span {
            position: relative;
        }

        .text-animation span::before {
            content: 'Full stack Developer';
            color: var(--main-color);
            animation: words 20s infinite;
        }

        .text-animation span::after {
            content: "";
            background-color: var(--main-color);
            position: absolute;
            width: calc(100% + 8px);
            height: 100%;
            border-left: 3px solid var(--bg-color);
            right: -8px;
            animation: cursor 0.6s infinite, typing 20s steps(14) infinite;
        }

        @keyframes cursor {
            to {
                border-left: 2px solid var(--main-color);
            }
        }

        @keyframes words {
            0%, 20% {
                content: 'office chérifien ocp jorf lasfar el jadida';
            }
            21%, 40% {
                content: "Strong Community Engagement";
            }
            41%, 60% {
                content: " Innovative Research and Development";
            }
            61%, 80% {
                content: "Cutting-Edge Infrastructure";
            }
            81%, 100% {
                content: "Expertise and Experience";
            }
        }

        @keyframes typing {
            10%, 15%, 30%, 35%, 50%, 55%, 70%, 75%, 90%, 95% {
                width: 0;
            }
            5%, 20%, 25%, 40%, 45%, 60%, 65%, 88%, 85% {
                width: calc(100% + 8px);
            }
        }

        .about {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5rem;
            background: var(--second-bg-color);
            color: white;
            padding: 5rem 9%;
        }

        .about h2 span {
            color: var(--main-color);
            text-shadow: 0 0 50px;
        }

        .about-img img {
            width: 50rem;
            border-radius: 6%;
            box-shadow: 0 0 25px var(--main-color);
            cursor: pointer;
            transition: 0.4s ease-in-out;
        }

        .about-img img:hover {
            box-shadow: 0 0 50px var(--main-color), 0 0 100px var(--main-color);
        }

        .about-content h2 {
            line-height: 1.5;
        }

        .about-content h3 {
            font-size: 2.6rem;
        }

        .about-content p {
            font-size: 1.6rem;
            margin: 2rem 0 3rem;
        }

        .services {
            padding: 5rem 9%;
            text-align: center;
        }

        .services h2 {
            margin-bottom: 5rem;
            color: white;
            font-size: 4rem;
            font-weight: 700;
        }

        .services-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5em;
        }

        .service-box {
            background-color: #90EE90;
            color: black;
            height: 250px;
            border-radius: 3rem;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .service-box:hover {
            background-color: black;
            color: var(--main-color);
            transform: scale(1.03);
        }

        .service-info {
            text-align: center;
        }

        .service-info h4 {
            font-size: 2.5rem;
            font-weight: 500;
            margin-bottom: 1rem;
            text-align: center;
            margin: 20px 0; /* Ajustez cette valeur selon vos besoins */


        }

        .service-info p {
            font-size: 1.6rem;
            font-weight: 400;
            max-height: 100px;
            overflow: hidden;
            margin: auto;
            text-align: left;
            padding-left: 20px; /* Ajustez cette valeur selon vos besoins */

        }
        .contact{
            background-color: var(--second-bg-color);
        }
        .contact h2{
            margin-bottom: 3rem;
            color:white;
        }
        .contact form .input-box input,
        .contact form textarea {
            width: 100%;
            padding: 1.5rem;
            font-size: 1.6rem;
            color: var(--text-color);
            background: var(--bg-color);
            border-radius: 0.8rem;
            border: 2px solid var(--main-color);
            margin: 1rem 0;
            resize: none;
        }

        .contact form .input-box input {
            display: block;
        }

        .contact form .input-box {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .contact form .input-box input {
            width: calc(50% - 1rem);
        }

        .contact form textarea {
            width: calc(100% - 2rem);
            margin: 1rem auto;
        }

        .contact form .btn{
            margin-top: 2rem;
        }

        .footer{
            position: relative;
            bottom: 0;
            width: 100%;
            padding:  40px 0;
            background-color: grey;
        }
        .footer .social{
            text-align: center;
            padding-bottom: 25px;
            color: var(--main-color);
        }
        .footer .social a{
            font-size: 25px;
            color: var(--main-color);
            border: 2px solid var(--main-color);
            width: 42px;
            height: 42px;
            line-height: 42px;
            display: inline-block;
            text-align: center;
            border-radius: 50%;
            margin : 0 10px;
            transition: 0.3s ease-in-out;
        }
        .footer .social a:hover{
            transform: scale(1.2)translateY((-10px));
            background-color: var(--main-color);
            color: var(--text-color);
            box-shadow: 0 0 25px var(--main-color);
        }
        .footer ul{
            margin-top: 0;
            padding: 0;
            font-size: 10px;
            line-height: 1.6;
            margin-bottom: 0;
            text-align: center;
        }
        .footer ul li a{
            color: white;
            border-bottom: 3px solid transparent;
            transition: 0.3s ease-in-out;
        }
        .footer ul li a:hover{
            color: var(--main-color);
            border-bottom: 3px solid var(--main-color);
        }
        .footer ul li{
            display: inline-block;
            padding: 0 15px;

        }
        .footer .copyright{
            margin-top: 50px;
            text-align: center;
            font-size: 16px;
            color: white;
            
        }


        @media(max-width: 1285px){
            html{
                font-size: 55%;
            }
            .services-container{
                padding-bottom: 7rem;
                grid-template-columns: repeat(2,1fr);
                margin: 0 5rem;
            }
        }
        @media(max-width: 991px) {
            .header {
                padding: 2rem 3%;
            }

            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a {
                margin-left: 0;
                margin-bottom: 1rem;
            }
        }

        @media(max-width:895px){
            #menu-icon{
                display: block;
            }
            .navbar{
                position: absolute;
                top: 100%;
                right:0;
                width:50%;
                padding: 1rem 3%;
                background-color: black;
                backdrop-filter: blur(20px);
                border-bottom-left-radius:2rem ;
                border-left: 2px solid var(--main-color);
                border-bottom: 2px solid var(--main-color);
            }
            .navbar.active{
                display: block;
                font-size: 2rem;
                margin: 3rem 0;
                color: white;
            }
            .home{
                flex-direction: column;
                margin:5rem 4rem;
            }
            .home-content h3{
                font-size: 2.6rem;
            }
            .home-content h1{
                font-size: 8rem;
                margin-top: 3rem;
            }
            .home-content p{
                max-width: 600px;
                margin: 0 auto;
            }
            .home-img img{
                width: 56vw;
                margin-top: -2rem;
            }
            .about{
                flex-direction: column-reverse;
            }
            .about-content{
                
                margin: 0 2rem 4rem;
            }
            .about img{
                width: 52vw;
                margin-top: 1rem;
                margin-bottom: 3rem;
            }
            .services h2{
                margin-bottom: 3rem;
            }
            .services-container{
                grid-template-columns: repeat(1,1fr);
            }
        }
                .partenaire-media {
            display: none;
            padding: 5rem 9%;
            background: var(--second-bg-color);
            color: white;
            text-align: center;
        }

        .partenaire-media h2 {
            margin-bottom: 3rem;
        }

        .partenaire-media p {
            font-size: 1.6rem;
            margin: 2rem 0;
        }



        .partenaire-media {
            display: block; /* Ensure the section is visible */
            padding: 5rem 9%;
            background: var(--second-bg-color);
            color: white;
            text-align: center;
        }

        .partenaire-media h2 {
            margin-bottom: 3rem;
        }



/* Style général pour la section des témoignages */
.testimonials-container {
    padding: 60px 0;
    background-color: black;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Style pour le conteneur du titre */
.title-container {
    text-align: center;
    margin-bottom: 40px;
    color: greenyellow;
}

.title {
    font-size: 4em;
    font-weight: bold;
    margin-bottom: 10px;
}

.subTitle {
    font-size: 2em;
    color: gray;
    margin: 0 auto;
    max-width: 800px;
}

/* Style pour les cartes de témoignages */
.testimonials-cards {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}

.testimonial-card {
    background: #fff;
    border-radius: 2px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    width: 100%;
    max-width: 350px;
    margin: 0 auto;
    text-align: center;
    position: relative;
    padding: 30px;
    transition: transform 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-10px);
}

/* Style pour les icônes de citation */
.quote-icon {
    font-size: 4em;
    color: #333;
    position: absolute;
    top: -10px;
    left: 20px;
    opacity: 0.1;
}

/* Style pour les photos */
.photo img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 70%;
    margin-bottom: 20px;
}

/* Style pour le contenu */
.content {
    padding: 0;
}

.testimonial-text {
    font-size: 2em;
    color: #333;
    margin-bottom: 15px;
    font-family: 'Georgia', serif; /* Police pour les citations */
    font-style: italic;
}

.name {
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 5px;
}

.role {
    font-size: 1.5em;
    color: #999;
}


/* mission */
/* Style général pour la section de la mission */
.mission-container {
    padding: 60px 0;
    background-color: var(--second-bg-color);
}

.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Style pour le conteneur du titre */
.title-container {
    text-align: center;
    margin-bottom: 30px;
}

.title {
    font-size: 2.5em;
    font-weight: bold;
    margin-bottom: 10px;
    color: greenyellow;
}

.subTitle {
    font-size: 2em;
    color: white;
    margin: 0 auto;
    max-width: 600px;
}

/* Style pour les éléments de mission */
.mission-items {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
}

.mission-item {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
    width: 100%;
    max-width: 280px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.mission-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
}

.icon img {
    width: 80px;
    height: 80px;
    margin-bottom: 15px;
}

h3 {
    font-size: 2em;
    color: #333;
    margin-bottom: 10px;
}

p {
    font-size: 1.6em;
    color: #666;
    text-align: left; /* Aligne le texte à gauche */
    text-indent: 30px; /* Indentation de la première ligne */
    margin: 20px 0; /* Espacement au-dessus et en-dessous du paragraphe */
}



/* history */
/* Style général pour la section historique */
.history-container {
    padding: 60px 0;
    background-color: black;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Style pour le conteneur du titre */
.title-container {
    text-align: center;
    margin-bottom: 40px;
}

.title {
    font-size: 2.5em;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.subTitle {
    font-size: 1.2em;
    color: #666;
    margin: 0 auto;
    max-width: 800px;
}

/* Style pour la ligne du temps */
.timeline {
    position: relative;
    padding: 20px 0;
    margin: 0 auto;
    max-width: 900px;
}

.timeline-item {
    position: relative;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.timeline-item::before {
    content: '';
    position: absolute;
    top: 20px;
    left: -20px;
    width: 10px;
    height: 100%;
    background: green;
    border-radius: 5px;
}

.year {
    font-size: 1.8em;
    font-weight: bold;
    color: green;
    margin-bottom: 10px;
}

.content h3 {
    font-size: 1.5em;
    color: #333;
    margin-bottom: 10px;
}

.content p {
    font-size: 1.2em;
    color: #666;
}


/* team */

/* Style général pour la section Équipe */
.team-container {
    padding: 60px 0;
    background-color: var(--second-bg-color);
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Style pour le conteneur du titre */
.title-container {
    text-align: center;
    margin-bottom: 40px;
}

.title {
    font-size: 2.5em;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.subTitle {
    font-size: 1.6em;
    color: greenyellow;
    margin: 0 auto;
    max-width: 800px;
}

/* Style pour la grille des membres de l'équipe */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

/* Style pour chaque membre de l'équipe */
.team-member {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.team-member:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
}

.photo img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 50%;
}

.info {
    padding: 20px;
}

.info h3 {
    font-size: 2em;
    color: #333;
    margin: 10px 0;
}

.position {
    font-size: 1.2em;
    color: green;
    margin-bottom: 10px;
}

.description {
    font-size: 1.8em;
    color: #666;
}






    </style>
</head>
<body>
<header class="header">
    <a href="#home" class="logo">
        <img src="logoRE.png" alt="Your Logo">
    </a>

    <nav class="navbar" >
        <a href="#home" class="active">Home</a>
        <a href="#about">About</a>
        <a href="#services">Services</a>
        <div class="dropdown">
            <a href="#features">Features</a>
            <div class="dropdown-content">
                <a href="#mission">Mission</a>
                <a href="#history">History</a>
                <a href="#team"> Team </a>
            </div>
        </div>
        <a href="#testimonials">Testimonials</a>
        <a href="#contact">Contact</a>
        

    </nav>
 
</header>

    <section class="home" id="home"> 
      <br> <br>

        <div class="home-img">
            <!-- <img src="imgOcp3.jpg" alt="Profile Picture"> -->
            <img src="imgOcp11.jpeg" alt="Profile Picture">

        </div>

        <div class="home-content">
            
            <h3 class="text-animation">
                It's  <span></span>
            </h3>
            <div class="social-icons">
                <a href="https://www.linkedin.com/company/ocpgroup/posts/?feedView=all"><i class='bx bxl-linkedin'></i></a>
                <a href="https://www.instagram.com/ocpgroup/?hl=fr"><i class='bx bxl-instagram'></i></a>
                <a href="https://www.facebook.com/OCPGroupMA/?locale=fr_FR"><i class='bx bxl-facebook-circle'></i></a>
                <a href="https://x.com/account/access"><i class='bx bxl-twitter'></i></a>
            </div>

            <a href="login.php" class="btn">Discover More</a>
        </div>
    </section>

    <section class="about" id="about" >
        <div class="about-content">
            <h2 class="heading"  style="font-size: 24px; font-family: 'Arial', sans-serif; font-weight: bold; font-style: italic;">About <span  style="font-size: 24px;">Us</span></h2> <br> <br>
            <h3  class="text-animation"><span></span></h3><br> <br>
            <p style=" color: black;
  font-family: 'Arial', sans-serif; /* Police Arial */
  font-size: 17px; /* Taille du texte */
  color: black; /* Couleur du texte, légèrement plus clair que #333 */
  line-height: 1.5; /* Espacement entre les lignes */
  margin: 1px 0; /* Marges en haut et en bas */
  padding: 2px; /* Espacement intérieur */
  border-radius: 3px; /* Coins légèrement arrondis */
  text-align: left; /* Alignement du texte à gauche */
">
  The OCP Group is a global leader in the phosphate industry, renowned for its comprehensive expertise in phosphate mining, production, and distribution. Founded in Morocco in 1920, OCP has grown into one of the largest and most innovative phosphate producers worldwide. Our commitment to excellence is reflected in our state-of-the-art facilities, cutting-edge research and development, and sustainable practices. With a robust presence across key markets, we provide essential phosphate solutions that support global agriculture, enhance soil fertility, and drive industrial advancement.
</p>

        </div>
        <div class="about-img">
            <img src="imgOcp33.jpg" alt="">
        </div>
    </section>

    <section class="services" id="services">
        <h2 class="heading">Services</h2>
        <div class="services-container">
            <div class="service-box">
                <div class="service-info">
                    <h4>Engrais Phosphatés</h4>
                    <p>L’OCP produit une gamme d’engrais phosphatés,qui sont utilisés pour améliorer la fertilité des sols agricoles.</p>                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Logistique et Transport</h4>
                    <p> Ils gèrent des infrastructures importantes pour le transport et la logistique, incluant des chemin de fer</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Développement Durable</h4>
                    <p>L’OCP met en œuvre des projets visant à réduire l'impact environnemental de ses activités</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Exploitation et Production de Phosphates</h4>
                    <p>L’OCP extrait et traite des minerais phosphatés principalement dans les mines de Khouribga, Benguerir, et Youssoufia.</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Partenariats et Développement International </h4>
                    <p>Ils collaborent avec des partenaires internationaux pour étendre leur portée sur les marchés mondiaux</p>
                </div>
            </div>



            <div class="service-box">
                <div class="service-info">
                <h4>Développement de Nouveaux Produits</h4>
                <p>Ils travaillent sur le développement de nouveaux produits chimiques</p>
                </div>
            </div>



            <div class="service-box">
                <div class="service-info">
                <h4>Commercialisation et Services Clients</h4>
                <p>Ils offrent des services aux clients internationaux, incluant des conseils sur l’utilisation optimale des produits phosphatés</p>
                </div>
            </div>

            <div class="service-box">
                <div class="service-info">
                    <h4>Gestion des Déchets</h4>
                    <p>Ils mettent en œuvre des solutions pour la gestion des résidus miniers et des sous-produits</p>
                </div>
            </div>
        </div>
    </section>



    <section class="mission-container" id="mission">
  <div class="container">
    <div class="title-container">
      <h1 style="
    font-size: 2.5em; /* Taille du texte */
    font-weight: white; /* Met le texte en gras */
    color: white; /* Couleur du texte */
    text-align: center; /* Centre le texte */
    margin: 0; /* Supprime les marges par défaut */
    padding: 20px 0; /* Ajoute de l'espace en haut et en bas */
    letter-spacing: 2px; /* Espace entre les lettres */
    font-family: 'Arial', sans-serif; /* Police de caractères */
">Our Mission</h2>
      <p class="subTitle">
        Discover how OCP is making a difference through innovation, research, environmental stewardship, and community engagement.
      </p>
    </div>
    <div class="mission-items">
      <div class="mission-item">
        <div class="icon">
          <img src="f11.webp" alt="Innovation en Fertilisants" />
        </div>
        <h3>Innovation en Fertilisants</h3>
        <p>
          L’OCP développe des fertilisants spécifiques pour différentes cultures et types de sol, optimisant ainsi leur efficacité et réduisant le gaspillage.
        </p>
      </div>
      <div class="mission-item">
        <div class="icon">
          <img src="f2.jpeg" alt="Projets de Recherche" />
        </div>
        <h3>Projets de Recherche</h3>
        <p>
          Collaboration avec des institutions académiques et de recherche pour améliorer les pratiques agricoles et les technologies d'extraction.
        </p>
      </div>
      <div class="mission-item">
        <div class="icon">
          <img src="f3.jpeg" alt="Initiatives Environnementales" />
        </div>
        <h3>Initiatives Environnementales</h3>
        <p>
          Programmes de reforestation et de réhabilitation des terres affectées par les activités minières.
        </p>
      </div>
      <div class="mission-item">
        <div class="icon">
          <img src="f4.jpg" alt="Engagement Communautaire" />
        </div>
        <h3>Engagement Communautaire</h3>
        <p>
          Investissements dans l'éducation, la santé et les infrastructures locales pour améliorer les conditions de vie dans les régions proches des sites d’exploitation.
        </p>
      </div>
    </div>
  </div>
</section>





<!-- history -->
<section class="history-container" id="history">
  <div class="container">
    <div class="title-container">
      <h2 class="title">Historique de l'OCP</h2>
      <p class="subTitle">
        Découvrez les grandes étapes qui ont façonné l'histoire de l'Office Chérifien des Phosphates.
      </p>
    </div>
    <div class="timeline">
      <div class="timeline-item">
        <div class="year">1920</div>
        <div class="content">
          <h3>Création de l'OCP</h3>
          <p>
            L'Office Chérifien des Phosphates a été fondé en 1920 pour exploiter les ressources phosphatières du Maroc.
          </p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="year">1960</div>
        <div class="content">
          <h3>Expansion des Opérations</h3>
          <p>
            Dans les années 1960, l'OCP a étendu ses opérations pour inclure de nouvelles mines et augmenter sa production.
          </p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="year">2000</div>
        <div class="content">
          <h3>Modernisation</h3>
          <p>
            Le début des années 2000 a marqué une période de modernisation avec l'adoption de nouvelles technologies pour améliorer l'efficacité.
          </p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="year">2020</div>
        <div class="content">
          <h3>Durabilité et Innovation</h3>
          <p>
            L'OCP a lancé plusieurs initiatives pour promouvoir la durabilité et l'innovation dans l'industrie des phosphates.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>





<!-- team -->


<section class="team-container" id="team">
  <div class="container">
    <div class="title-container">
    <h1 style="
    font-size: 2.5em; /* Taille du texte */
    font-weight: white; /* Met le texte en gras */
    color: white; /* Couleur du texte */
    text-align: center; /* Centre le texte */
    margin: 0; /* Supprime les marges par défaut */
    padding: 20px 0; /* Ajoute de l'espace en haut et en bas */
    letter-spacing: 2px; /* Espace entre les lettres */
    font-family: 'Arial', sans-serif; /* Police de caractères */
">
Our Team

</h1>
      <p class="subTitle">
        Rencontrez les membres clés de notre équipe qui dirigent et inspirent l'Office Chérifien des Phosphates.
      </p>
    </div>
    <div class="team-grid">
      <div class="team-member">
        <div class="photo"> <br> <br>
          <img src="Mostafa-Terrab.jpg" alt="Nom du Membre 1">
        </div>
        <div class="info">
          <h3>Mostafa Terrab</h3>
          <p class="position">Président-Directeur Général</p>
          <p class="description">
          Depuis son arrivée, il dirige la transformation du Groupe et, dans ce cadre, a également piloté la création et le développement de l’Université Mohammed VI Polytechnique.
        </p>
        </div>
      </div>
      <div class="team-member">
        <div class="photo">
          <img src="farisDerraj.jpeg" alt="Nom du Membre 2">
        </div>
        <div class="info">
          <h3>Faris Derrij
          </h3>
          <p class="position">Managing Director – SBU Mining</p>
          <p class="description">
          Chargée d'assurer les activités d'Exploitation et d'Exploration sur le périmètre minier actuel du Groupe OCP, tout en améliorant le Cost Leadership du Groupe OCP.
        </p>
        </div>
      </div>
      <div class="team-member">
        <div class="photo">
          <img src="ahmedMahrou.jpeg" alt="Nom du Membre 3">
        </div>
        <div class="info">
          <h3>
 
                Ahmed MAHROU</h3>
          <p class="position">Managing Director–SBU Manufacturing
          </p>
          <p class="description">
                Chargé d'assurer les activités d'Exploitation et d'Exploration sur les plateformes de transformation actuelles du Groupe OCP          </p>
        </div>
      </div>
      <div class="team-member">
        <div class="photo">
          <img src="NadiaFassiFehri.jpEg" alt="Nom du Membre 4">
        </div>
        <div class="info"> <br> <br> <br> <br>
          <h3>Nadia FASSI FEHRI
          </h3>
          <p class="position">Managing Director–SBU Rock Solutions</p>
          <p class="description">
          En tant que dépositaire responsable des plus grandes réserves de phosphate au monde, le Groupe OCP est résolument engagé dans la préservation de cette ressource en faveur des générations           </p>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="testimonials-container" id="testimonials">
  <div class="container">
    <div class="title-container">
      <h2 class="title">What Our Team and Partners Say</h2>
      <p class="subTitle">
        Hear from the professionals and partners who have experienced working with OCP.
      </p>
    </div>
    <div class="testimonials-cards">
      <div class="testimonial-card">
        <div class="photo">
          <img src="t3.png" alt="Rachid El Idrissi" />
        </div>
        <div class="content">
          <div class="testimonial-text">
            "OCP's commitment to innovation and sustainability has been a game-changer in the phosphate industry. Working with them has been a rewarding experience."
          </div>
          <div class="name">Rachid El Idrissi</div>
          <div class="role">Chief Operating Officer</div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="photo">
          <img src="t2.png" alt="Amina Boukhris" />
        </div>
        <div class="content">
          <div class="testimonial-text">
            "Being part of OCP's projects has allowed me to grow both professionally and personally. Their focus on sustainable practices is truly impressive."
          </div>
          <div class="name">Amina Boukhris</div>
          <div class="role">Environmental Engineer</div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="photo">
          <img src="t1.jpg" alt="Said Chouaib" />
        </div>
        <div class="content">
          <div class="testimonial-text">
            "OCP’s dedication to advancing the phosphate industry through innovative solutions is unparalleled. I’m proud to be associated with such a forward-thinking organization."
          </div>
          <div class="name">Said Chouaib</div>
          <div class="role">Senior Geologist</div>
        </div>
      </div>
    </div>
  </div>
</section>












<section class="contact" id="contact">
<h2 class="heading"  style="font-size: 24px; font-family: 'Arial', sans-serif; font-weight: bold; font-style: italic;"> <center>Contact Us</center>  </h2> <br> <br>
<form action="#">
        <div class="input-box">
            <input type="text" placeholder="Full Name">
            <input type="email" placeholder="Email">
        </div>
        <div class="input-box">
            <input type="number" placeholder="Phone Number">
            <input type="text" placeholder="Subject">
        </div>
        <textarea name="message" cols="30" rows="10" placeholder="Your message"></textarea>
         <center><input type="submit" value="Send Message" class="btn"></center>
    </form>
</section>






    <footer class="footer">
        <div class="social">
                <a href="https://www.linkedin.com/company/ocpgroup/posts/?feedView=all"><i class='bx bxl-linkedin'></i></a>
                <a href="https://www.instagram.com/ocpgroup/?hl=fr"><i class='bx bxl-instagram'></i></a>
                <a href="https://www.facebook.com/OCPGroupMA/?locale=fr_FR"><i class='bx bxl-facebook-circle'></i></a>
                <a href="https://x.com/account/access"><i class='bx bxl-twitter'></i></a>
        </div>
        <ul class="list">
            <li>
                <a href="">FAQ</a>
            </li>

            <li>
                <a href="">FAQ</a>
            </li>

            <li>
                <a href="">Services</a>
            </li>

            <li>
                <a href="">About Me</a>
            </li>

            <li>
                <a href="">Contact</a>
            </li>

            <li>
                <a href="">FAQ</a>
            </li>

            <li>
                <a href="">Privacy Policy</a>
            </li>

        </ul>
        <p class="copyright">
            @Ocp PhosPoll 2024 | All Rights Reserved
        </p>
    </footer>



    <script>


    </script>




    
</script>




</body>
</html>