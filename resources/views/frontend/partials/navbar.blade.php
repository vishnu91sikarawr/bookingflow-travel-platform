<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">

    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            BookingFlow
        </a>

        <button class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="navbar-collapse" id="navbar">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact
                    </a>
                </li>

               @auth

    @if(auth()->user()->hasRole('Customer'))

        <li class="nav-item">
            <a class="nav-link"
               href="{{ route('my-bookings') }}">
                My Bookings
            </a>
        </li>

    @endif


    <li class="nav-item">

        <form method="POST"
              action="{{ route('logout') }}">

            @csrf

            <button type="submit"
                    class="btn btn-link nav-link">

                Logout

            </button>

        </form>

    </li>


@else

    <li class="nav-item">

        <a class="nav-link"
           href="{{ route('login') }}">
            Login
        </a>

    </li>


    <li class="nav-item">

        <a class="nav-link"
           href="{{ route('register') }}">
            Register
        </a>

    </li>

@endauth

            </ul>

        </div>

    </div>

</nav>
