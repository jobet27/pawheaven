<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <style>
        :root {
            --c-primary: #5c7c5c;
            --c-bg: #f8f9f8;
            --c-text: #2d342d;
            --font-main: 'Inter', system-ui, -apple-system, sans-serif;
        }
        
        body {
            margin: 0;
            padding: 0;
            background-color: var(--c-bg);
            color: var(--c-text);
            font-family: var(--font-main);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .error-404-container {
            max-width: 600px;
            padding: 2rem;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .error-illustration {
            font-size: 8rem;
            margin-bottom: 1.5rem;
            line-height: 1;
        }

        .error-code {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--c-primary);
            margin-bottom: 1rem;
            display: block;
        }

        h1 {
            font-size: 3rem;
            margin: 0 0 1.5rem;
            font-weight: 800;
        }

        p {
            font-size: 1.125rem;
            color: #616e61;
            line-height: 1.6;
            margin-bottom: 2.5rem;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            background-color: var(--c-primary);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(92, 124, 92, 0.2);
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(92, 124, 92, 0.3);
            background-color: #4a634a;
        }

        .pet-footprints {
            position: absolute;
            bottom: 5vh;
            left: 0;
            right: 0;
            opacity: 0.1;
            font-size: 2rem;
            letter-spacing: 1.5rem;
            pointer-events: none;
        }
    </style>
</head>
<body <?php body_class(); ?>>

    <div class="error-404-container">
        <div class="error-illustration">🐕</div>
        <span class="error-code"><?php _e('Error 404', 'pawhaven'); ?></span>
        <h1><?php _e('Lost your way?', 'pawhaven'); ?></h1>
        <p><?php _e("It looks like the page you're searching for has wandered off. Don't worry, we'll help you find your way back to the pack.", 'pawhaven'); ?></p>
        
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-home">
            <?php _e('Back to Safety', 'pawhaven'); ?>
        </a>
    </div>

    <div class="pet-footprints">
        🐾 🐾 🐾 🐾 🐾
    </div>

    <?php wp_footer(); ?>
</body>
</html>
