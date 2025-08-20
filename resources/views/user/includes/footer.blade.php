<footer class="main-footer">
    <div class="footer-top">
        <div class="footer-col">
            <h3>{{ __('front.about_municipality') }}</h3>
            <ul>
                <li><a href="{{ route('about') }}">{{ __('front.about_us') }}</a></li>
                <li><a href="{{ route('projects') }}">{{ __('front.projects') }}</a></li>
                <li><a href="{{ route('services') }}">{{ __('front.services') }}</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>{{ __('front.quick_links') }}</h3>
            <ul>
                <li><a href="{{ route('importantLinks.index') }}">{{ __('front.important_links') }}</a></li>
                <li><a href="{{ route('questions') }}">{{ __('front.faq') }}</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>{{ __('front.contact_us') }}</h3>
            <p><i class="fas fa-phone-alt"></i> {{ $setting->phone }}</p>
            <p><i class="fas fa-envelope"></i> {{ $setting->email }}</p>
            <div class="social-icons">
                <a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a>
                <a href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a>
                <a href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>

        <div class="footer-col newsletter">
            <h3>{{ __('front.newsletter') }}</h3>
            <form id="newsletter-form" class="newsletter-form">
                @csrf
                <input type="email" name="email" placeholder="{{ __('front.enter_email') }}" required>
                <button type="submit"><i class="fas fa-paper-plane"></i></button>
            </form>
            <div id="newsletter-message" style="display: none; margin-top: 10px;"></div>
        </div>

        <script>
            document.getElementById('newsletter-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const form = this;
                const messageDiv = document.getElementById('newsletter-message');
                const submitBtn = form.querySelector('button');
                const email = form.querySelector('input[name="email"]').value;

                // Disable button during request
                submitBtn.disabled = true;

                fetch('{{ route('newsletter.subscribe') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            messageDiv.innerHTML = '<div style="color: green;">' + data.message + '</div>';
                            form.reset();
                        } else {
                            messageDiv.innerHTML = '<div style="color: red;">' + (data.message ||
                                'An error occurred') + '</div>';
                        }
                        messageDiv.style.display = 'block';
                    })
                    .catch(error => {
                        messageDiv.innerHTML =
                        '<div style="color: red;">An error occurred. Please try again.</div>';
                        messageDiv.style.display = 'block';
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                    });
            });
        </script>
    </div>

    <div class="footer-bottom">
        {{ __('front.copyright') }}
    </div>
</footer>
