<nav class="nav-wrap">
    <h1><a class="logo" href="{{ url.get({"for": "home"}) }}">Unique</a></h1>
    <a class="nav-toggle" data-nav-toggle="#nav-menu" href="#">Menu</a>
    <div class="nav-collapse" id="nav-menu">
        <ul class="nav">
            {% if identity.exists() %}
            <li>Welcome {{ identity.getName() }}</li>
            <li><a href="{{ url.get({"for": "group"}) }}" >Group</a></li>
            <li><a href="{{ url.get({"for": "account-logout"}) }}" >Logout</a></li>
            {% else %}
            <li><a href="{{ url.get({"for": "account-login"}) }}" >Login</a></li>
            <li><a href="{{ url.get({"for": "account-signup"}) }}" >Signup</a></li>
            {% endif %}
        </ul>
    </div>
</nav>