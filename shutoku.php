<?PHP
$URL = "https://nandeyanen.ie-t.net/talkit/register.php"; //取得したいサイトのURL
$html_source = file_get_contents($URL);
echo $html_source;
?>
<style>
/* 繝吶�繧ｹ繧ｹ繧ｿ繧､繝ｫ */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    color: #333;
    transition: background-color 0.3s ease;
}

header {
    background-color: #0078d7;
    color: #fff;
    padding: 10px 0;
    text-align: center;
    animation: fadeIn 1s ease-in-out;
}

header .logo h1 {
    margin: 0;
    font-size: 2em;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    animation: slideIn 1s ease-in-out;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    position: relative;
    transition: color 0.3s ease;
}

nav ul li a::before {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -5px;
    left: 50%;
    background-color: #fff;
    transition: width 0.3s ease, left 0.3s ease;
}

nav ul li a:hover {
    color: #ffdb58;
}

nav ul li a:hover::before {
    width: 100%;
    left: 0;
}

.container {
    display: flex;
    padding: 20px;
    animation: fadeIn 1s ease-in-out;
}

.left, .right {
    flex: 1;
    margin: 10px;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.left {
    max-width: 300px;
}

.right {
    max-width: auto;
}

.left:hover, .right:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.user-button {
    display: block;
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    background-color: #0078d7;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    box-sizing: border-box;
    transition: background-color 0.3s ease;
}

.user-button:hover {
    background-color: #0056b3;
}

.user-button.logout {
    background-color: #d9534f;
}

.user-button.logout:hover {
    background-color: #c9302c;
}

.right img {
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
}

details {
    margin: 20px 0;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    animation: fadeIn 1s ease-in-out;
}

summary {
    cursor: pointer;
    font-weight: bold;
}

.announcement-board {
    margin: 20px 0;
    animation: slideIn 1s ease-in-out;
}

.announcement-board h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.announcement {
    padding: 10px;
    background-color: #e9ecef;
    border-radius: 5px;
    margin-bottom: 10px;
}

p a {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
    display: block;
    text-align: center;
    margin-bottom: 20px;
    transition: color 0.3s ease;
}

p a:hover {
    color: #0056b3;
}

.service {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    animation: fadeIn 1s ease-in-out;
}

.grid-item {
    background-color: #ffffff;
    border: none;
    padding: 20px;
    font-size: 1.2em;
    text-align: center;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-decoration: none;
    color: #333;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.grid-item img.icon {
    margin-right: 10px;
    width: 30px;
    height: 30px;
}

.grid-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

footer {
    background-color: #0078d7;
    color: #fff;
    padding: 10px 0;
    text-align: center;
    animation: fadeIn 1s ease-in-out;
}

footer a {
    color: #fff;
    text-decoration: none;
    margin: 0 10px;
    transition: text-decoration 0.3s ease;
}

footer a:hover {
    text-decoration: underline;
}

/* 繧ｹ繝槭�繝医ヵ繧ｩ繝ｳ逕ｨ縺ｮ繝ｬ繧ｹ繝昴Φ繧ｷ繝悶ョ繧ｶ繧､繝ｳ */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .left, .right {
        margin: 10px 0;
        padding: 10px;
    }

    .left {
        max-width: 100%;
    }

    nav ul {
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }

    nav ul li {
        margin: 5px;
    }

    .service {
        grid-template-columns: 1fr;
    }

    .grid-item {
        font-size: 1em;
    }

    input[type="text"] {
        width: calc(100% - 70px);
    }

    #send {
        padding: 10px;
    }

    footer {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    footer a {
        margin: 5px;
        flex: 1 1 auto;
        text-align: center;
    }
}

@media (max-width: 480px) {
    header .logo h1 {
        font-size: 1.5em;
    }

    nav ul li a {
        font-size: 0.9em;
    }

    footer a {
        font-size: 0.8em;
    }
}

/* 繧｢繝九Γ繝ｼ繧ｷ繝ｧ繝ｳ */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes highlight {
    from { background-color: #f0f0f0; }
    to { background-color: #ffcc00; }
}
.browser-mockup {
display:none;
}
</style>