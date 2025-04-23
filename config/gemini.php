<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Gemini API Key
    |--------------------------------------------------------------------------
    |
    | Here you may specify your Gemini API Key and organization. This will be
    | used to authenticate with the Gemini API - you can find your API key
    | on Google AI Studio, at https://makersuite.google.com.
    */

    'api_key' => env('GEMINI_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Gemini Base URL
    |--------------------------------------------------------------------------
    |
    | If you need a specific base URL for the Gemini API, you can provide it here.
    | Otherwise, leave empty to use the default value.
    */
    'base_url' => env('GEMINI_BASE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | The timeout may be used to specify the maximum number of seconds to wait
    | for a response. By default, the client will time out after 30 seconds.
    */

    'request_timeout' => env('GEMINI_REQUEST_TIMEOUT', 30),

    'prompt_opportunity_detected' => 'You are given the plain text of an email.
        If the email contains a job opportunity or an update regarding a job application,
        return a JSON object with the following fields.
        All fields are required and should mandatory fill them with relevant value,
        thus empty and `null` values are not acceptable. You may search the internet for relevant values.

        - `name`: The job title (e.g., "Software Engineer").
        - `company`: The name of the company offering the job.
        - `companyLogo`: A publicly accessible logo URL of the company (e.g., from their website or a logo CDN).
        - `url`: A link to the job post or application, if not inferred then use the company website.
        - `description`: A brief summary of the opportunity.
        - `date`: The date from the email relevant to the opportunity in ISO 8601 format (e.g., `2025-04-18T09:00:00Z`).
        - `status`: One of `applied`, `interview`, `offer`, or `reject`. Choose based on the content of the email. And if you inferred other status then choose the nearest status mentioned or discard the whole result by returning only `null` as final output.

        If the email does NOT contain relevant job information, return `null`.

        Example Output:
        { "name": "Full-Stack Developer", "company": "Acme Corp", "companyLogo": "https://logo.clearbit.com/acmecorp.com", "url": "https://jobs.acmecorp.com/fullstack-developer", "description": "Acme Corp is hiring a Full-Stack Developer proficient in React and Node.js to join their growing team.", "date": "2025-04-18T08:00:00Z", "status": "applied" }

        Use the following heuristics for `status`:

        - "Thank you for your application" → `applied`
        - "We would like to schedule an interview" → `interview`
        - "We are extending you an offer" → `offer`
        - "Unfortunately..." or rejections → `reject`

        Here is the text:

        %s',

    'prompt_job_recommended' => "Analyze the following job post and return only 'true' or 'false'
             based on whether ALL of the following conditions are met:
             1. One or more of the following is a primary requirement (discard this condition if no requirements supplied): %s.
             2. One or more of the following is NOT a primary requirement (discard this condition if no requirements supplied): %s.

             Here is the job post:

             %s",
];
