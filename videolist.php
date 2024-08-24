<?php
/* Template Name: Video Section */
get_header();
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .video-section {
        width: 90%;
        max-width: 800px;
        padding: 20px;
    }

    .section-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
        text-align: left;
        margin-left: 10px;
    }

    .video-container {
        position: relative;
        overflow-x: hidden;
        padding: 10px;
    }

    .video-wrapper {
        display: flex;
        scroll-behavior: smooth;
        overflow-x: scroll;
        scrollbar-width: none; /* Hide scrollbar in Firefox */
    }

    .video-wrapper::-webkit-scrollbar {
        display: none; /* Hide scrollbar in Chrome/Safari */
    }

    .video-wrapper iframe {
        width: calc(3.5in * 9 / 16); /* 16:9 aspect ratio for vertical videos */
        height: 3.5in;
        margin-right: 15px;
        border: none;
        flex-shrink: 0;
        background-color: #000;
    }

    .scroll-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
        transition: background-color 0.3s, transform 0.3s;
    }

    .scroll-btn:hover {
        background-color: rgba(0, 0, 0, 0.9);
        transform: scale(1.1);
    }

    .scroll-left {
        left: 10px;
    }

    .scroll-right {
        right: 10px;
    }

    .scroll-btn svg {
        width: 20px;
        height: 20px;
        fill: #fff;
    }
</style>

<div class="video-section">
    <div class="section-title">Product Videos</div>
    <div class="video-container">
        <button class="scroll-btn scroll-left" onclick="scrollLeft()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
            </svg>
        </button>
        <div class="video-wrapper">
            <?php
            // Retrieve YouTube URLs from ACF field
            if (have_rows('youtube_shorts')) :
                while (have_rows('youtube_shorts')) : the_row();
                    $video_url = get_sub_field('video_url');
                    $video_id = preg_replace('/.*\/shorts\/([^?]+).*/', '$1', $video_url);
                    ?>
                    <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?autoplay=1&mute=1" allowfullscreen></iframe>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
        <button class="scroll-btn scroll-right" onclick="scrollRight()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z"/>
            </svg>
        </button>
    </div>
</div>

<script>
    const container = document.querySelector('.video-wrapper');

    function scrollLeft() {
        container.scrollBy({ left: -300, behavior: 'smooth' });
    }

    function scrollRight() {
        container.scrollBy({ left: 300, behavior: 'smooth' });
    }
</script>

<?php get_footer(); ?>
