<nav class="nav-wrap">
    <a class="logo" href="#">Unique</a>
    <a class="nav-toggle" data-nav-toggle="#nav-menu" href="#">Menu</a>
    <div class="nav-collapse" id="nav-menu">
        <ul class="nav">
            <li><a href="{{ url.get({"for": "home"}) }}" >Home</a></li>

            {% if identity.exists() %}
            <li>Welcome {{ identity.getName() }}</li>
            <li><a href="{{ url.get({"for": "account-logout"}) }}" >Logout</a></li>
            {% else %}
            <li><a href="{{ url.get({"for": "account-login"}) }}" >Login</a></li>
            <li><a href="{{ url.get({"for": "account-signup"}) }}" >Signup</a></li>
            {% endif %}
        </ul>
    </div>
</nav>