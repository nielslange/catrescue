( () => {
	const input = document.querySelector( '#searchform-1' );
	input.addEventListener( 'focus', event => event.target.value = '' );
} ) ();