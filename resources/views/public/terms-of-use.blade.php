<x-layouts.public :title="__('Terms of Use')">
    <section class="min-h-[80vh] flex justify-center px-6">
        <div class="max-w-3xl">
            <h1 class="text-5xl text-center font-extrabold leading-tight mb-6 text-gray-900 dark:text-white">
                Terms of Use
            </h1>
            <div class="mb-8 text-gray-700 dark:text-gray-300">
                <p>Effective Date: April 26, 2025</p>
                <p>Welcome to JobFlow, operated by JobFlow ("we," "us," or "our"). By accessing or using our platform,
                    you agree to these Terms of Use.</p>

                <h2>1. Acceptance of Terms</h2>
                <p>By using JobFlow, you confirm that you are at least 18 years old and agree to be bound by these Terms
                    and all applicable laws and regulations.</p>

                <h2>2. User Accounts</h2>
                <p>You must create an account to apply for jobs. You agree to provide accurate and complete information
                    and to keep your account secure.</p>

                <h2>3. Use of the Platform</h2>
                <p>You agree to use JobFlow only for lawful purposes. You may not:
                <ul>
                    <li>Submit false or misleading information.</li>
                    <li>Use the platform to spam or harass others.</li>
                    <li>Attempt to gain unauthorized access to our systems.</li>
                </ul>
                </p>

                <h2>4. Intellectual Property</h2>
                <p>All content on JobFlow, including text, graphics, and software, is the property of PrimaCores UG or
                    its licensors and protected by applicable copyright and trademark laws.</p>

                <h2>5. Termination</h2>
                <p>We may suspend or terminate your account at any time for violation of these Terms.</p>

                <h2>6. Disclaimers</h2>
                <p>JobFlow is provided "as is" without warranties of any kind. We do not guarantee job placement or the
                    accuracy of listings.</p>

                <h2>7. Limitation of Liability</h2>
                <p>To the extent permitted by law, we will not be liable for any indirect or consequential damages
                    arising out of your use of JobFlow.</p>

                <h2>8. Governing Law</h2>
                <p>These Terms are governed by the laws of Germany.</p>

                <h2>9. Contact</h2>
                <p>For questions, contact us at <a
                        href="mailto:{{ env('APP_ADMIN_EMAIL', '') }}">{{ env('APP_ADMIN_EMAIL', '') }}</a>.</p>
            </div>
        </div>
    </section>
</x-layouts.public>
