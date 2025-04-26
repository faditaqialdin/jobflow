<x-layouts.public :title="__('Privacy Policy')">
    <section class="min-h-[80vh] flex justify-center px-6">
        <div class="max-w-3xl">
            <h1 class="text-5xl text-center font-extrabold leading-tight mb-6 text-gray-900 dark:text-white">
                Privacy Policy
            </h1>
            <div class="mb-8 text-gray-700 dark:text-gray-300">
                <p>Effective Date: April 26, 2025</p>
                <p>This Privacy Policy describes how JobFlow collects, uses, and protects your personal information on
                    the JobFlow platform.</p>

                <h2>1. Information We Collect</h2>
                <p>We collect the following data:
                <ul>
                    <li>Account information (name, email, resume, etc.)</li>
                    <li>Job application history</li>
                    <li>OAuth data if you connect Gmail or LinkedIn</li>
                </ul>
                </p>

                <h2>2. How We Use Your Information</h2>
                <p>We use your information to:
                <ul>
                    <li>Provide and personalize the JobFlow service</li>
                    <li>Allow you to apply for jobs</li>
                    <li>Send notifications about application status</li>
                    <li>Improve our platform and offerings</li>
                </ul>
                </p>

                <h2>3. Sharing Your Information</h2>
                <p>We do not sell your data. We may share data with:
                <ul>
                    <li>Employers when you apply for jobs</li>
                    <li>Service providers who support our operations</li>
                    <li>Authorities if legally required</li>
                </ul>
                </p>

                <h2>4. Data Security</h2>
                <p>We use technical and organizational measures to protect your data, including encryption and access
                    controls.</p>

                <h2>5. Data Retention</h2>
                <p>We retain your data for as long as your account is active or as needed to fulfill legal
                    obligations.</p>

                <h2>6. Your Rights</h2>
                <p>You have the right to access, correct, or delete your personal data. To exercise your rights, contact
                    us at <a href="mailto:{{ env('APP_ADMIN_EMAIL', '') }}">{{ env('APP_ADMIN_EMAIL', '') }}</a>.</p>

                <h2>7. International Data Transfers</h2>
                <p>If you are located outside the EU, your data may be transferred to and processed in the EU. We ensure
                    adequate safeguards are in place.</p>

                <h2>8. Updates to this Policy</h2>
                <p>We may update this Privacy Policy from time to time. Changes will be posted on this page with an
                    updated effective date.</p>

                <h2>9. Contact</h2>
                <p>For questions, contact us at <a
                        href="mailto:{{ env('APP_ADMIN_EMAIL', '') }}">{{ env('APP_ADMIN_EMAIL', '') }}</a>.</p>
            </div>
        </div>
    </section>
</x-layouts.public>
