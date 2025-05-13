document.addEventListener("DOMContentLoaded", function () {
	// Button elements
	const signupBtn = document.querySelector("#buttons li button");
	const signInButtons = document.querySelectorAll("#sign-in");
	const signUpButtons = document.querySelectorAll("#sign-up");
	const signUpBtn_submit = document.querySelector("#sign-up-submit");
	const nextBtn = document.querySelector("#next-btn");

	// Modal elements
	const signupModalOverlay = document.getElementById("signup-modal-overlay");
	const signinModalOverlay = document.getElementById("signin-modal-overlay");
	const goflowModalOverlay = document.getElementById("goflow-modal-overlay");

	// Function to hide all modals - with null checks
	function hideAllModals() {
		signupModalOverlay?.classList.add("hidden");
		signinModalOverlay?.classList.add("hidden");
		goflowModalOverlay?.classList.add("hidden");
	}

	// Function to show error message
	function showError(elementId, message) {
		const errorElement = document.getElementById(elementId);
		if (errorElement) {
			errorElement.textContent = message;
			errorElement.classList.remove("hidden");

			// Hide error after 5 seconds
			setTimeout(() => {
				errorElement.classList.add("hidden");
			}, 5000);
		}
	}

	// Handle sign-up form submission
	const signupForm = document.getElementById("signup-form");
	if (signupForm) {
		signupForm.addEventListener("submit", async function (e) {
			e.preventDefault();

			// Create loading indicator
			const submitButton = this.querySelector('button[type="submit"]');
			const originalButtonText = submitButton.textContent;
			submitButton.textContent = "Processing...";
			submitButton.disabled = true;

			try {
				const formData = new FormData(this);

				// Validate passwords match client-side
				if (formData.get("password") !== formData.get("confirm_password")) {
					showError("signup-error", "Password and confirmation do not match");
					submitButton.textContent = originalButtonText;
					submitButton.disabled = false;
					return;
				}

				const response = await fetch("actions/signup-action.php", {
					method: "POST",
					headers: {
						"X-Requested-With": "XMLHttpRequest",
					},
					body: formData,
				});

				const data = await response.json();

				if (response.ok) {
					// Success - store credentials for auto-login
					sessionStorage.setItem("signup_success", "true");
					sessionStorage.setItem("signup_username", formData.get("email"));
					sessionStorage.setItem("signup_password", formData.get("password"));
					window.location.href = "index.php";
				} else {
					// Show error message
					showError(
						"signup-error",
						data.error || "An error occurred during signup"
					);
				}
			} catch (err) {
				console.error("Signup error:", err);
				showError("signup-error", "Network error. Please try again later.");
			} finally {
				// Reset button state
				submitButton.textContent = originalButtonText;
				submitButton.disabled = false;
			}
		});
	}

	// Show sign up modal when clicking sign up button
	if (signupBtn && signupModalOverlay) {
		signupBtn.addEventListener("click", function (e) {
			e.stopPropagation();
			hideAllModals();
			signupModalOverlay.classList.remove("hidden");
		});
	}

	// Handle click on sign in button in sign up modal
	if (signinModalOverlay) {
		signInButtons.forEach((button) => {
			button.addEventListener("click", function (e) {
				e.stopPropagation();
				hideAllModals();
				signinModalOverlay.classList.remove("hidden");
			});
		});
	}

	// Handle click on sign up button in sign in modal
	if (signupModalOverlay) {
		signUpButtons.forEach((button) => {
			button.addEventListener("click", function (e) {
				e.stopPropagation();
				hideAllModals();
				signupModalOverlay.classList.remove("hidden");
			});
		});
	}

	// Close modal when clicking outside
	document.querySelectorAll(".modal-overlay").forEach((overlay) => {
		overlay.addEventListener("click", function () {
			overlay.classList.add("hidden");
		});

		const modal = overlay.querySelector(".modal");
		if (modal) {
			modal.addEventListener("click", function (e) {
				e.stopPropagation();
			});
		}
	});

	// Toggle password visibility
	const togglePasswordButtons = document.querySelectorAll(".toggle-password");
	togglePasswordButtons.forEach((button) => {
		button.addEventListener("click", function () {
			const input = this.previousElementSibling;
			const icon = this.querySelector("i.material-icons");
			if (input && icon) {
				if (input.type === "password") {
					input.type = "text";
					icon.textContent = "visibility";
					icon.alt = "Hide password";
				} else {
					input.type = "password";
					icon.textContent = "visibility_off";
					icon.alt = "Show password";
				}
			}
		});
	});

	// Check for signup success in session storage
	if (
		sessionStorage.getItem("signup_success") === "true" &&
		goflowModalOverlay
	) {
		// Show the go-with-flow modal after signup
		hideAllModals();
		goflowModalOverlay.classList.remove("hidden");

		// Clear the flag to prevent showing the modal again on refresh
		sessionStorage.removeItem("signup_success");
	}

	// Handle Go Flow modal arrow button click to log in
	const goFlowArrowButton = document.getElementById("go-arrow");
	if (goFlowArrowButton && goflowModalOverlay) {
		goFlowArrowButton.addEventListener("click", async function () {
			// Get username and password from sessionStorage
			const username = sessionStorage.getItem("signup_username");
			const password = sessionStorage.getItem("signup_password");

			if (!username || !password) {
				showError(
					"goflow-error",
					"Could not log in automatically. Please sign in manually."
				);
				setTimeout(() => {
					goflowModalOverlay.classList.add("hidden");
				}, 3000);
				return;
			}

			// Send AJAX POST to login
			try {
				const response = await fetch("actions/signin-action.php", {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded",
						"X-Requested-With": "XMLHttpRequest",
					},
					body: `email=${encodeURIComponent(
						username
					)}&password=${encodeURIComponent(password)}`,
				});

				// Remove loading indicator
				if (loadingIndicator) {
					loadingIndicator.remove();
				}

				// Process response
				if (response.ok) {
					try {
						// Try to parse JSON response if available
						const data = await response.json().catch(() => null);

						if (data && data.error) {
							// Server returned an error in JSON format
							showError("goflow-error", data.error);
							setTimeout(() => {
								goflowModalOverlay.classList.add("hidden");
							}, 3000);
						} else {
							// Success - clean up and redirect
							sessionStorage.removeItem("signup_password");
							sessionStorage.removeItem("signup_username");
							window.location.href = "index.php";
						}
					} catch (jsonError) {
						// Not JSON or parsing error, assume success
						sessionStorage.removeItem("signup_password");
						sessionStorage.removeItem("signup_username");
						window.location.href = "index.php";
					}
				} else {
					// HTTP error status
					if (response.status === 401) {
						showError(
							"goflow-error",
							"Invalid username or password. Please sign in manually."
						);
					} else if (response.status === 429) {
						showError(
							"goflow-error",
							"Too many login attempts. Please try again later."
						);
					} else {
						showError(
							"goflow-error",
							`Login failed (Error ${response.status}). Please sign in manually.`
						);
					}

					// Hide modal after a delay
					setTimeout(() => {
						goflowModalOverlay.classList.add("hidden");
					}, 3000);
				}
			} catch (err) {
				// Network error or other exception
				console.error("Login error:", err);
				showError(
					"goflow-error",
					"Network error. Please check your connection and try again."
				);

				// Hide modal after a delay
				setTimeout(() => {
					goflowModalOverlay.classList.add("hidden");
				}, 3000);
			}
		});
	}

	// Handle sign-in form submission
	const signinForm = document.getElementById("signin-form");
	if (signinForm) {
		signinForm.addEventListener("submit", async function (e) {
			e.preventDefault();

			// Create loading indicator
			const submitButton = this.querySelector('button[type="submit"]');
			const originalButtonText = submitButton.textContent;
			submitButton.textContent = "Processing...";
			submitButton.disabled = true;

			try {
				const formData = new FormData(this);
				const response = await fetch("actions/signin-action.php", {
					method: "POST",
					headers: {
						"X-Requested-With": "XMLHttpRequest",
					},
					body: formData,
				});

				if (response.ok) {
					try {
						// Try to parse JSON response if available
						const data = await response.json().catch(() => null);

						if (data && data.error) {
							// Server returned an error in JSON format
							showError("signin-error", data.error);
						} else {
							// Success - redirect
							window.location.href = "index.php";
						}
					} catch (jsonError) {
						// Not JSON or parsing error, assume success
						window.location.href = "index.php";
					}
				} else {
					// HTTP error status
					try {
						const errorData = await response.json().catch(() => null);
						if (errorData && errorData.error) {
							showError("signin-error", errorData.error);
						} else if (response.status === 401) {
							showError("signin-error", "Invalid email or password.");
						} else {
							showError(
								"signin-error",
								`Login failed (Error ${response.status}).`
							);
						}
					} catch (jsonError) {
						showError("signin-error", "An error occurred during sign-in.");
					}
				}
			} catch (err) {
				console.error("Signin error:", err);
				showError("signin-error", "Network error. Please try again later.");
			} finally {
				// Reset button state
				submitButton.textContent = originalButtonText;
				submitButton.disabled = false;
			}
		});
	}
});
