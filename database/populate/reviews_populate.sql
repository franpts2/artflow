-- Reviews for completed exchanges
-- Only clients who have completed exchanges can leave reviews
INSERT INTO Review (
        user_id,
        service_id,
        rating,
        comment,
        created_at,
        exchange_id
    )
VALUES -- Reviews for Exchange ID 1: Client 5 ordered service 1 from freelancer 2
    (
        5,
        1,
        5.0,
        'Excellent logo design! Perfectly captured our tech startup vibe with the blue color scheme. Very professional and responsive freelancer.',
        '2025-05-15 09:23:14',
        1
    ),
    -- Reviews for Exchange ID 2: Client 6 ordered service 2 from freelancer 3
    (
        6,
        2,
        4.0,
        'Great brand identity work for our bakery. The pink elements were incorporated beautifully. Only reason for 4 stars is a slight delay in delivery.',
        '2025-05-14 14:45:32',
        2
    ),
    -- Reviews for Exchange ID 6: Client 3 ordered service 6 from freelancer 7
    (
        3,
        6,
        5.0,
        'The vintage-style logo for our bakery is perfect! Exceeded all expectations and delivered ahead of schedule.',
        '2025-05-22 17:12:05',
        6
    ),
    -- Reviews for Exchange ID 8: Client 6 ordered service 8 from freelancer 2
    (
        6,
        8,
        5.0,
        'Amazing geometric tattoo design. Clean lines and exactly what I was looking for. Will definitely order again.',
        '2025-05-23 10:06:41',
        8
    ),
    -- Reviews for Exchange ID 10: Client 5 ordered service 10 from freelancer 4
    (
        5,
        10,
        3.0,
        'The 3D model of the lamp was good, but required several revisions to match our modern style vision. Decent work overall.',
        '2025-05-22 15:38:53',
        10
    ),
    -- Reviews for Exchange ID 12: Client 8 ordered service 12 from freelancer 6
    (
        8,
        12,
        5.0,
        'Perfect minimal logo for our tech event. Clean, modern, and exactly what we needed. Fast communication and delivery!',
        '2025-05-23 09:17:29',
        12
    ),
    -- Additional reviews for balance (Exchange ID 5)
    (
        2,
        5,
        4.0,
        'Good quality 3D model of the chair. Modern style was well-executed. Could have used more detailed texturing.',
        '2025-05-21 13:44:10',
        5
    ),
    -- Reviews for Exchange ID 13: Client 4 ordered service 1 from freelancer 2
    (
        4,
        1,
        4.0,
        'Great logo redesign for our fashion brand. Communication was smooth, and the designer understood our vision.',
        '2025-05-07 11:21:35',
        13
    ),
    -- Reviews for Exchange ID 14: Client 7 ordered service 2 from freelancer 3
    (
        7,
        2,
        5.0,
        'Outstanding brand identity for our restaurant! Every element was thoughtfully designed. Will definitely recommend.',
        '2025-05-10 16:32:47',
        14
    ),
    -- Reviews for Exchange ID 15: Client 5 ordered service 7 from freelancer 8
    (
        5,
        7,
        5.0,
        'The digital illustration for our book cover is stunning. Captured the essence of the story perfectly.',
        '2025-05-17 12:09:54',
        15
    ),
    -- Reviews for Exchange ID 16: Client 8 ordered service 3 from freelancer 4
    (
        8,
        3,
        5.0,
        'Beautiful oil painting of our family. The attention to detail is remarkable, and the artist was a pleasure to work with.',
        '2025-05-04 14:19:23',
        16
    ),
    -- Reviews for Exchange ID 17: Client 2 ordered service 6 from freelancer 7
    (
        2,
        6,
        4.0,
        'Very nice logo design for our fitness studio. Clean, modern, and energetic, just as requested.',
        '2025-05-19 17:42:08',
        17
    ),
    -- Reviews for Exchange ID 18: Client 3 ordered service 4 from freelancer 5
    (
        3,
        4,
        5.0,
        'Incredibly detailed tattoo sleeve design. The artist incorporated all my ideas while adding their artistic touch. Couldn´t be happier!',
        '2025-05-20 11:28:36',
        18
    ),
    -- Reviews with half-point ratings
    -- Reviews for Exchange ID 5: Client 2 ordered service 5 from freelancer 6
    (
        2,
        5,
        3.5,
        'The 3D chair model was well done with good attention to the modern style requested. Some minor issues with the textures, but overall a satisfying result.',
        '2025-05-21 08:30:22',
        5
    ),
    -- Reviews for Exchange ID 13: Client 4 ordered service 13 from freelancer 7
    (
        4,
        13,
        4.5,
        'The knitted scarf exceeded my expectations! Beautiful floral pattern and excellent craftsmanship. Just a tiny issue with one edge, otherwise perfect.',
        '2025-05-19 11:24:36',
        13
    ),
    -- Reviews for Exchange ID 14: Client 2 ordered service 14 from freelancer 8
    (
        2,
        14,
        2.5,
        'Digital portrait had good fantasy elements but didn''t quite capture my likeness. Artist was responsive to feedback but the final result was just average.',
        '2025-05-20 14:52:17',
        14
    ),
    -- Reviews for Exchange ID 15: Client 3 ordered service 15 from freelancer 2
    (
        3,
        15,
        1.5,
        'UI design for fitness app was far from what we discussed. Navigation elements were confusing and color scheme didn''t match our brand. Needed many revisions.',
        '2025-05-18 09:36:49',
        15
    ),
    -- Reviews for Exchange ID 16: Client 5 ordered service 16 from freelancer 3
    (
        5,
        16,
        0.5,
        'Very disappointed with these brand guidelines. Completely missed the brief, colors were wrong, and typography choices were unprofessional. Unusable result.',
        '2025-05-17 16:27:33',
        16
    ),
    -- Reviews for Exchange ID 17: Client 6 ordered service 17 from freelancer 4
    (
        6,
        17,
        2.0,
        'The watercolor landscape had technical skill but lacked the mountain atmosphere I was looking for. Colors were too muted and composition felt unbalanced.',
        '2025-05-16 13:41:08',
        17
    ),
    -- Reviews for Exchange ID 18: Client 2 ordered service 18 from freelancer 5
    (
        2,
        18,
        4.5,
        'Minimalist tattoo design for my wrist is almost perfect! Clean lines, elegant design, and fits the space beautifully. Just needed a tiny tweak to the size.',
        '2025-05-15 15:09:27',
        18
    ),
    -- Reviews for Exchange ID 19: Client 3 ordered service 19 from freelancer 6
    (
        3,
        19,
        3.5,
        'The 3D futuristic car model had great details and innovative design elements. Some issues with the proportions prevented it from being perfect.',
        '2025-05-14 10:56:14',
        19
    ),
    -- Reviews for Exchange ID 20: Client 5 ordered service 20 from freelancer 7
    (
        5,
        20,
        1.0,
        'The doll arrived with stitching issues and the outfit was nothing like what I requested. Very disappointed with the quality and attention to detail.',
        '2025-05-13 17:33:42',
        20
    ),
    -- Reviews for new exchanges
    (
        7,
        21,
        4.5,
        'The minimalist digital portraits for our team were fantastic! Each one captured the personality perfectly while maintaining a consistent style. Minor adjustments needed for one portrait.',
        '2025-05-23 09:45:18',
        21
    ),
    (
        8,
        25,
        5.0,
        'Absolutely stunning pottery set! The craftsmanship is exceptional, and the custom glazing perfectly matches our wedding theme. Worth every penny!',
        '2025-05-24 14:20:33',
        22
    ),
    (
        4,
        30,
        4.0,
        'Beautiful henna design for our wedding. The intricate patterns were gorgeous, though the application took longer than expected. Still very happy with the result!',
        '2025-05-24 16:55:27',
        23
    ),
    (
        9,
        40,
        4.5,
        'The watercolor series exceeded expectations! Each painting captures the essence of nature beautifully. The artist really understood the vision.',
        '2025-05-22 11:30:15',
        25
    ),
    (
        5,
        45,
        5.0,
        'Incredible 3D visualization of our house design! The attention to detail, lighting, and materials is remarkable. The architect loved it too!',
        '2025-05-21 13:40:52',
        26
    ),
    (
        3,
        55,
        4.0,
        'The macramé installation is a beautiful centerpiece in our office. Great craftsmanship, though installation took a bit longer than planned.',
        '2025-05-20 15:25:09',
        28
    ),
    (
        4,
        60,
        5.0,
        'Exceptional animation work! Each character action is fluid and perfectly captures the intended mood. The extra expressions added were a wonderful bonus.',
        '2025-05-17 14:20:33',
        29
    ),
    (
        5,
        65,
        4.5,
        'The website design is modern and user-friendly. Great attention to responsive design and accessibility. Just needed minor tweaks to the contact form.',
        '2025-05-18 16:45:27',
        30
    ),
    (
        7,
        75,
        5.0,
        'The engagement ring is absolutely perfect! The attention to detail in the rose gold work and stone setting is exceptional. My fiancée loves it!',
        '2025-05-19 10:30:15',
        32
    ),
    (
        8,
        80,
        4.5,
        'Very professional product launch animation. The timing and transitions are perfect, and it really highlights our product features well.',
        '2025-05-20 09:15:42',
        33
    ),
    (
        10,
        90,
        5.0,
        'The silk scarf is a masterpiece! The cherry blossom pattern is delicate and the colors are vibrant. Excellent craftsmanship!',
        '2025-05-21 11:25:18',
        35
    ),
    (
        11,
        95,
        4.5,
        'Stunning VR walkthrough! The attention to lighting and materials makes it incredibly realistic. Client was very impressed.',
        '2025-05-22 13:40:55',
        36
    ),
    (
        13,
        105,
        5.0,
        'The dining table is absolutely gorgeous! The epoxy river design exceeded our expectations. A true piece of functional art.',
        '2025-05-20 14:30:22',
        38
    ),
    (
        14,
        110,
        4.0,
        'Great motion graphics work! The intro really matches our channel´s style. Would have liked slightly faster delivery.',
        '2025-05-21 17:55:43',
        39
    ),
    (
        5,
        120,
        4.5,
        'Excellent social media templates! Very versatile and easy to customize. Perfect for our brand´s aesthetic.',
        '2025-05-22 12:15:31',
        41
    ),
    (
        6,
        125,
        5.0,
        'The wedding invitation suite is perfect! Every piece is beautifully designed and the paper quality is excellent.',
        '2025-05-23 14:20:17',
        42
    ),
    (
        7,
        130,
        4.5,
        'Outstanding photo retouching work! Natural-looking results that enhanced each photo while maintaining authenticity.',
        '2025-05-24 09:35:48',
        43
    ),
    (
        9,
        140,
        4.0,
        'Solid storyboard work that really helped visualize our commercial. Communication was great throughout the process.',
        '2025-05-23 11:45:29',
        45
    ),
    (
        10,
        145,
        5.0,
        'The meditation app interface is both beautiful and intuitive. User testing showed great results!',
        '2025-05-22 16:30:12',
        46
    ),
    (
        12,
        155,
        5.0,
        'Amazing wedding photography! Captured every special moment and delivered a beautiful collection of memories.',
        '2025-05-21 15:25:38',
        48
    ),
    (
        13,
        160,
        4.5,
        'The e-commerce site works flawlessly. Great features and smooth payment integration. Minor delay in delivery.',
        '2025-05-20 17:40:53',
        49
    ),
    (
        14,
        165,
        4.0,
        'Beautiful throw pillows with excellent print quality. Colors match our interior perfectly.',
        '2025-05-19 13:15:27',
        50
    );