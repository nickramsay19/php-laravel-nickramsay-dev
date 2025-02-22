<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="dev, developer, programming, c, cpp, python prog, math, aus, australia, sydney, nsw, algo, debug, books, memory" />
        <meta name="viewport" content="width=device-width" />
        
        <title>nickramsay.dev</title>
        
        <style>
            :root {
                --color-bg0:       #0f0f0f;
                --color-bg1:       #181818;
                --color-darkgray:  #2f2f2f;
                --color-lightgray: #404040;
                --color-disabled:  #5f5f5f;
                --color-accent:    #74bfff;
                --color-bright:    #eeeeee;
                --color-danger:    #ff5f5f;
            }

            body {
                background-color: var(--color-bg0);
                font-size: 0.9em;
                color: var(--color-bright);
                margin: 0px;
            }

            body, code, pre {
                font-family: ui-monospace, 'Cascadia Code', 'Source Code Pro', 'Segoe UI Mono', 'Liberation Mono', Menlo, Monaco, Consolas, monospace;
            }

            .container {
                width: 60%;
                margin: auto;
            }

            div#content {
                background-color: var(--color-bg1);
                clear: both;
                padding: 10px;
                border-radius: 2px;

                margin-top: 1em;
            }

            @media only screen and (max-width: 600px) {
                .container {
                    width: 100%;
                    margin: 0;
                }

                div#content {
                    margin-top: 0px;
                }
            }

            a.link {
                text-decoration: none;
                color: var(--color-accent); 
            }

            h1 { 
                color: var(--color-accent); 
                text-decoration: none; 
                font-size: 1.5em; 
                border-bottom: 2px solid var(--color-accent); 
            }

            h2 { 
                font-size: 1.5em; 
                margin-top: 50px; 
            }

            h2::before { 
                content: '# '; 
            }



            img { margin: 10px 0px 10px 0px; box-shadow: 5px 5px 5px 0 #111; max-width: 100%; }
            img[alt=centerimg]     { margin-left: auto; margin-right: auto; display: block; }
            img[alt=floatleftimg]  { float: left;  margin-right: 10px; }
            img[alt=floatrightimg] { float: right; margin-left:  10px; }

            code { background-color: var(--color-lightgray); }
            pre { overflow: auto; }
            pre, pre code { background-color: var(--color-bg0); }

            table { border-collapse: collapse; margin: auto; }
            table th { background-color: var(--color-lightgray); }
            table td { background-color: var(--color-darkgray); }
            table td, table th {
                border: 1px solid var(--color-lightgray);
                text-align: center;
                padding: 5px;
                min-width: 20px;
            }

            blockquote p {
                font-style: italic;
                padding: 0.9em;
                background-color: var(--color-bg);
            }

            /* == FORMS == */
            input, textarea {
                border-color: #74bfff; 
                border-style: solid; 
                border-width: 1px; 
                background-color: #171717; 
                color: #eeeeee;
            }

            input[type=submit] {
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #74bfff;
                color: #171717;
            }

            /* == POST BANNERS == */
            .post-banner {
                margin-bottom: 1em;
                padding-left: 8px;
                border-left: 3px solid var(--color-accent);

                font-size: 0.85em;
                /* color: var(--color-accent); */
            }

            .post-banner h3.post-title {
                font-size: 1.4em;
                font-weight: bold;
                text-decoration: underline;
                color: var(--color-accent);

                margin: 0;
            }

            .post-banner h3.post-title a, article.post-banner span.post-tags a {
                color: var(--color-accent);
            }

            /* == HEADER == */
            #header-bar {
                display: flex;
                justify-content: space-between;
            }

            #header-bar-nav {
                margin-left: auto;
            }

            #header-bar-nav a.social-link {
                margin-right: 1em; 
                text-decoration: none;
            }

            #header-bar-nav a.social-link svg {
                width: 1.5em;
                height: 1.5em;

                fill: var(--color-bright);
            }

            #header p a {
                color: var(--color-accent);
            }

            @media only screen and (max-width: 600px) {

                #linkedin-social-link {
                    display: none;
                }

                #header-bar-title {
                    font-size: 0.7em;

                    letter-spacing: -0.5px;

                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                #header-bar-nav nav {
                    display: flex;
                }

                #header-bar-nav a.social-link {
                    max-width: 1em;
                    margin: 0px;
                    margin-left: 0.4em; 
                }

                #header-bar-nav a.social-link svg {
                    width: 1em;
                    height: 1em;
                }
            }

            /* == FOOTER == */
            #footer { 
                text-align: center; 
                display: block; 

                margin-top: 2em;
            }
        </style>
    </head>
    <body>
        <div class="container" id="content">
            @if (Auth::check()) 
                <small style="margin: 0;">Logged in: {{ Auth::user()->name }}</small>
            @endif

            <header id="header">
                <x-nav.link to="home">nickramsay.dev</x-nav.link> /

                @for ($i = 0; $i < count(Request::segments())-1; $i++)
                    <x-link href="/{{ implode('/', array_slice(Request::segments(), 0, $i+1)) }}">{{ Request::segment($i+1) }}</x-link > /
                @endfor
                
                <h1 id="header-bar">
                    <span id="header-bar-title">{{ $attributes->get('title', 'Nicholas Ramsay') ?? '1111Nicholas Ramsay' }}</a></span>
                    
                    <span id="header-bar-nav">
                        <nav>
                            <a id="github-social-link" class="social-link" href="https://github.com/nickramsay19">
                                <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>GitHub</title>
                                    <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                                </svg>
                            </a>

                            <a id="twitter-social-link" class="social-link" href="https://twitter.com/nickramsay15">
                                <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>Twitter</title>
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>    
                            <a id="linkedin-social-link" class="social-link" href="https://www.linkedin.com/in/nicholas-ramsay-01799b147/">
                                <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>LinkedIn</title>
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </nav>
                    </span>
                </h1>
            </header>

            <main> 
                {{ $slot }}
            </main>

            <footer id="footer">
                nickramsay.dev | 
                <x-nav.link to="home">home</x-nav.link>
                <x-nav.link to="posts">posts</x-nav.link>
                @if (Auth::check()) 
                    <x-nav.link to="logout">logout</x-nav.link>
                @else
                    <x-nav.link to="login">login</x-nav.link>
                @endif
                
            </footer>
        </div>
    </body>
</html>
