
//nav

if ( window.innerWidth <= 838) { // If media query matches
    const nav_button = document.getElementsByClassName( 'nav__burger' )[0];
    nav_button.addEventListener( "click", function(){
        if( document.body.classList.contains( 'nav-open' ) ){
            document.body.classList.remove( 'nav-open' );
        }
        else {
            document.body.classList.add( 'nav-open' );
        }
    });
}

//login form pop up
// const login_open = document.getElementsByClassName( 'nav__login__open' )[0];
// login_open.addEventListener( "click", function(){
//      document.body.classList.add( 'login-open' );
// });

// const login_close = document.getElementsByClassName( 'login-form__close' )[0];
// login_close.addEventListener( "click", function(){
//      document.body.classList.remove( 'login-open' );
// });

//sign up form pop up
// const signUp__open = document.getElementsByClassName( 'nav__signUp__open' )[0];
// signUp__open.addEventListener( "click", function(){
//      document.body.classList.add( 'signUp-open' );
// });

// const signUp__close = document.getElementsByClassName( 'signUp-form__close' )[0];
// signUp__close.addEventListener( "click", function(){
//      document.body.classList.remove( 'signUp-open' );
// });

const login_open = document.getElementsByClassName( 'nav__login__open' );
const login_close = document.getElementsByClassName( 'login-form__close' );
const signUp__open = document.getElementsByClassName( 'nav__signUp__open' );
const signUp__close = document.getElementsByClassName( 'signUp-form__close' );

for( let i=0; i<login_open.length; i++ ) {
    login_open[i].addEventListener( "click", function(){
        document.body.classList.add( 'login-open' );
        document.body.classList.remove( 'signUp-open' );
    });
}

for( let i=0; i<login_close.length; i++ ) {
    login_close[i].addEventListener( "click", function(){
        document.body.classList.remove( 'login-open' );
    });
}

for( let i=0; i<signUp__open.length; i++ ) {
    signUp__open[i].addEventListener( "click", function(){
        document.body.classList.add( 'signUp-open' );
        document.body.classList.remove( 'login-open' );
    });
}

for( let i=0; i<signUp__close.length; i++ ) {
    signUp__close[i].addEventListener( "click", function(){
        document.body.classList.remove( 'signUp-open' );
    });
}

//