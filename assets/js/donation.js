document.addEventListener( 'DOMContentLoaded', function () {
	const donationForm = document.getElementById( 'donation-form' );
	const donationUrls = JSON.parse( donationForm.dataset.donationUrls );
	const donateButton = document.getElementById( 'donate-button' );
	const typeSelect = document.getElementById( 'donation-type' );
	const frequencySelect = document.getElementById( 'donation-frequency' );
	const descriptionBox = document.getElementById( 'donation-description' );

	// Initially disable the button
	donateButton.disabled = true;
	donateButton.classList.add( 'disabled' );

	function updateDonateButton() {
		const selectedType = typeSelect.value;
		const selectedFrequency = frequencySelect.value;

		// Update description
		if ( selectedType && donationUrls[ selectedType ].description ) {
			descriptionBox.textContent = donationUrls[ selectedType ].description;
			descriptionBox.style.display = 'block';
		} else {
			descriptionBox.style.display = 'none';
		}

		// Enable button only if both selections are made
		if ( selectedType && selectedFrequency ) {
			donateButton.disabled = false;
			donateButton.classList.remove( 'disabled' );

			const urls = donationUrls[ selectedType ];
			let targetUrl;

			switch ( selectedFrequency ) {
				case 'once':
					targetUrl = urls.once;
					break;
				case 'monthly':
					targetUrl = urls.monthly;
					break;
				case 'yearly':
					targetUrl = urls.yearly;
					break;
			}

			donateButton.onclick = function () {
				window.open( targetUrl, '_blank' );
			};
		} else {
			donateButton.disabled = true;
			donateButton.classList.add( 'disabled' );
		}
	}

	typeSelect.addEventListener( 'change', updateDonateButton );
	frequencySelect.addEventListener( 'change', updateDonateButton );

	// Initialize button state
	updateDonateButton();
} );
