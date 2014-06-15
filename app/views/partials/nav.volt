<nav class="nav-wrap">
    <h1><a class="logo" href="{{ url.get({"for": "home"}) }}">undefined</a></h1>
    <a class="nav-toggle" data-nav-toggle="#nav-menu" href="#">Menu</a>
    <div class="nav-collapse" id="nav-menu">
        <ul class="nav">
            {% if identity.exists() %}
            <li>
                <span class="text-tall">
                    Welcome {{ identity.get('name')|capitalize }}
                </span>
                <span class="text-muted">
                    Rep: {{ identity.get('reputation') }}
                    Role: {{ identity.get('role') }}
                </span>
            </li>
            <li><a href="{{ url.get({"for": "item-overview"}) }}" >Items</a></li>
            <li><a href="{{ url.get({"for": "group"}) }}" >Hubs</a></li>
            <li><a href="{{ url.get({"for": "commands"}) }}" >Hubs</a></li>
            <li><a href="{{ url.get({"for": "account-logout"}) }}" >Logout</a></li>
            {% else %}
            <li><a href="{{ url.get({"for": "account-login"}) }}" >Login</a></li>
            <li><a href="{{ url.get({"for": "account-signup"}) }}" >Signup</a></li>
            {% endif %}
        </ul>
    </div>
</nav>