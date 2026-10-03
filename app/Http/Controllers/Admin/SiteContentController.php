<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class SiteContentController extends Controller
{
    private array $defaults = [
        // Ã¢â€â‚¬Ã¢â€â‚¬ HOME HERO
        ['key'=>'hero_eyebrow',       'label'=>'Eyebrow Text',          'section'=>'Home - Hero',   'type'=>'text',     'placeholder'=>'Artisan Bakery Since 2018'],
        ['key'=>'hero_title_main',    'label'=>'Title Line 1',          'section'=>'Home - Hero',   'type'=>'text',     'placeholder'=>'Homemade Desserts'],
        ['key'=>'hero_title_sub',     'label'=>'Title Line 2',          'section'=>'Home - Hero',   'type'=>'text',     'placeholder'=>'in Kettering by'],
        ['key'=>'hero_title_brand',   'label'=>'Brand Name in Title',   'section'=>'Home - Hero',   'type'=>'text',     'placeholder'=>'Current Cravings'],
        ['key'=>'hero_desc',          'label'=>'Hero Description',      'section'=>'Home - Hero',   'type'=>'textarea', 'placeholder'=>'Enjoy our freshly baked treats, from soft, chewy cookies and rich, fudgy brownies to irresistibly moist tres leches cakes. Every bite is made with love.'],
        ['key'=>'hero_image',         'label'=>'Hero Main Image',       'section'=>'Home - Hero',   'type'=>'image',    'placeholder'=>''],
        // -- HOME HERO CARDS
        ['key'=>'hero_card_1_heading','label'=>'Card 1 Heading',        'section'=>'Home - Hero Cards','type'=>'text',    'placeholder'=>'Homemade Desserts'],
        ['key'=>'hero_card_2_heading','label'=>'Card 2 Heading',        'section'=>'Home - Hero Cards','type'=>'text',    'placeholder'=>'Signature Cookies'],
        ['key'=>'hero_card_3_heading','label'=>'Card 3 Heading',        'section'=>'Home - Hero Cards','type'=>'text',    'placeholder'=>'Brownie Bliss'],
        ['key'=>'hero_card_4_heading','label'=>'Card 4 Heading',        'section'=>'Home - Hero Cards','type'=>'text',    'placeholder'=>'Celebration Cakes Layered'],
        ['key'=>'hero_card_1_desc',   'label'=>'Card 1 Paragraph',      'section'=>'Home - Hero Cards','type'=>'textarea','placeholder'=>'Handcrafted delights made with heritage grains and seasonal ingredients. From our hearth to your heart.'],
        ['key'=>'hero_card_2_desc',   'label'=>'Card 2 Paragraph',      'section'=>'Home - Hero Cards','type'=>'textarea','placeholder'=>'Golden edges, soft centers, and rich butter notes with a melt-in-your-mouth finish.'],
        ['key'=>'hero_card_3_desc',   'label'=>'Card 3 Paragraph',      'section'=>'Home - Hero Cards','type'=>'textarea','placeholder'=>'Dense, crackly tops and intense cocoa flavor - made for true chocolate lovers.'],
        ['key'=>'hero_card_4_desc',   'label'=>'Card 4 Paragraph',      'section'=>'Home - Hero Cards','type'=>'textarea','placeholder'=>'Soft sponge layers, silky frosting, and a finish that feels like a party.'],
        // Ã¢â€â‚¬Ã¢â€â‚¬ HOME BANNER
        ['key'=>'banner_title',       'label'=>'Banner Heading',        'section'=>'Home - Banner', 'type'=>'text',     'placeholder'=>'White Choco Cookie'],
        ['key'=>'banner_desc',        'label'=>'Banner Description',    'section'=>'Home - Banner', 'type'=>'textarea', 'placeholder'=>'Soft and chewy cookies loaded with creamy white chocolate chips, offering a sweet and buttery flavor that\'s simply irresistible.'],
        ['key'=>'banner_image',       'label'=>'Banner Product Image',  'section'=>'Home - Banner', 'type'=>'image',    'placeholder'=>''],
        // Ã¢â€â‚¬Ã¢â€â‚¬ HOME ABOUT
        ['key'=>'about_quote',        'label'=>'Baker Quote',           'section'=>'Home - About',  'type'=>'text',     'placeholder'=>'Baking is a conversation between science and the soul.'],
        ['key'=>'about_text1',        'label'=>'About Paragraph 1',    'section'=>'Home - About',  'type'=>'textarea', 'placeholder'=>'We started as a small home bakery in Kettering with a simple mission Ã¢â‚¬â€ to bring real, homemade desserts to your door.'],
        ['key'=>'about_text2',        'label'=>'About Paragraph 2',    'section'=>'Home - About',  'type'=>'textarea', 'placeholder'=>'Today, we lead a team of passionate artisans who believe that high-quality ingredients shouldn\'t be a luxury, but a standard.'],
        ['key'=>'about_image',        'label'=>'Baker Photo',           'section'=>'Home - About',  'type'=>'image',    'placeholder'=>''],
        ['key'=>'about_owner_name',   'label'=>'Owner Name',            'section'=>'Home - About',  'type'=>'text',     'placeholder'=>'Elena Rodriguez'],
        ['key'=>'about_owner_role',   'label'=>'Owner Job Title',       'section'=>'Home - About',  'type'=>'text',     'placeholder'=>'Founder & Head Baker'],
        ['key'=>'about_owner_image',  'label'=>'Owner Profile Photo',   'section'=>'Home - About',  'type'=>'image',    'placeholder'=>''],
        // Ã¢â€â‚¬Ã¢â€â‚¬ MENU PAGE
        ['key'=>'menu_hero_title',    'label'=>'Menu Page Heading',     'section'=>'Menu Page',     'type'=>'text',     'placeholder'=>'Our Sweet Menu'],
        ['key'=>'menu_hero_desc',     'label'=>'Menu Page Description', 'section'=>'Menu Page',     'type'=>'textarea', 'placeholder'=>'Every item handcrafted fresh each day. Zero preservatives, all love.'],
        // Ã¢â€â‚¬Ã¢â€â‚¬ ABOUT PAGE
        ['key'=>'about_page_title',   'label'=>'Page Heading',          'section'=>'About Page',    'type'=>'text',     'placeholder'=>'About Current Cravings'],
        ['key'=>'about_page_story',   'label'=>'Our Story Text',        'section'=>'About Page',    'type'=>'textarea', 'placeholder'=>'We started as a small home bakery in Kettering with a simple mission Ã¢â‚¬â€ to bring real, homemade desserts to your door.'],
        ['key'=>'about_page_image',   'label'=>'About Page Hero Image', 'section'=>'About Page',    'type'=>'image',    'placeholder'=>''],
        ['key'=>'about_page_mission', 'label'=>'Mission Statement',     'section'=>'About Page',    'type'=>'textarea', 'placeholder'=>'Every bite we bake is made with love, the finest ingredients, and zero shortcuts.'],
        ['key'=>'about_page_pill',    'label'=>'Hero Pill',             'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Our Story'],
        ['key'=>'about_page_cta1_text','label'=>'Hero CTA 1 Text',      'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Explore Menu'],
        ['key'=>'about_page_cta1_url','label'=>'Hero CTA 1 URL',        'section'=>'About Page',    'type'=>'text',     'placeholder'=>'/menu'],
        ['key'=>'about_page_cta2_text','label'=>'Hero CTA 2 Text',      'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Order Now'],
        ['key'=>'about_page_cta2_url','label'=>'Hero CTA 2 URL',        'section'=>'About Page',    'type'=>'text',     'placeholder'=>'/cart'],
        ['key'=>'about_page_stat1_value','label'=>'Hero Stat 1 Value',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'45K+'],
        ['key'=>'about_page_stat1_label','label'=>'Hero Stat 1 Label',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Treats baked'],
        ['key'=>'about_page_stat2_value','label'=>'Hero Stat 2 Value',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'120+'],
        ['key'=>'about_page_stat2_label','label'=>'Hero Stat 2 Label',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Signature recipes'],
        ['key'=>'about_page_badge1_title','label'=>'Hero Badge 1 Title','section'=>'About Page',    'type'=>'text',     'placeholder'=>'Small Batch'],
        ['key'=>'about_page_badge1_text','label'=>'Hero Badge 1 Text',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Fresh daily'],
        ['key'=>'about_page_badge2_title','label'=>'Hero Badge 2 Title','section'=>'About Page',    'type'=>'text',     'placeholder'=>'100% Real'],
        ['key'=>'about_page_badge2_text','label'=>'Hero Badge 2 Text',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'No preservatives'],
        ['key'=>'about_page_section2_title_before','label'=>'Section 2 Title Line 1','section'=>'About Page','type'=>'text','placeholder'=>'A Home Bakery'],
        ['key'=>'about_page_section2_title_highlight','label'=>'Section 2 Highlight','section'=>'About Page','type'=>'text','placeholder'=>'With Soul'],
        ['key'=>'about_page_feature1_title','label'=>'Feature 1 Title',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Handcrafted Daily'],
        ['key'=>'about_page_feature1_desc','label'=>'Feature 1 Description','section'=>'About Page', 'type'=>'textarea', 'placeholder'=>'Freshly baked every morning in limited batches.'],
        ['key'=>'about_page_feature2_title','label'=>'Feature 2 Title',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Ingredient First'],
        ['key'=>'about_page_feature2_desc','label'=>'Feature 2 Description','section'=>'About Page', 'type'=>'textarea', 'placeholder'=>'Real butter, real chocolate, zero preservatives.'],
        ['key'=>'about_page_feature3_title','label'=>'Feature 3 Title',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Gift Ready'],
        ['key'=>'about_page_feature3_desc','label'=>'Feature 3 Description','section'=>'About Page', 'type'=>'textarea', 'placeholder'=>'Beautifully packed for every celebration.'],
        ['key'=>'about_page_gallery_image1','label'=>'Gallery Image 1',  'section'=>'About Page',    'type'=>'image',    'placeholder'=>''],
        ['key'=>'about_page_gallery_image2','label'=>'Gallery Image 2',  'section'=>'About Page',    'type'=>'image',    'placeholder'=>''],
        ['key'=>'about_page_gallery_image3','label'=>'Gallery Image 3',  'section'=>'About Page',    'type'=>'image',    'placeholder'=>''],
        ['key'=>'about_page_gallery_image4','label'=>'Gallery Image 4',  'section'=>'About Page',    'type'=>'image',    'placeholder'=>''],
        ['key'=>'about_page_process_pill','label'=>'Process Pill',       'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Our Process'],
        ['key'=>'about_page_process_title','label'=>'Process Section Title','section'=>'About Page', 'type'=>'text',     'placeholder'=>'From Kitchen to Door'],
        ['key'=>'about_page_process_desc','label'=>'Process Section Description','section'=>'About Page','type'=>'textarea','placeholder'=>'Every step is designed to keep your desserts fresh, beautiful, and ready to celebrate.'],
        ['key'=>'about_page_process1_title','label'=>'Process Card 1 Title','section'=>'About Page', 'type'=>'text',     'placeholder'=>'Small Batch Bake'],
        ['key'=>'about_page_process1_desc','label'=>'Process Card 1 Description','section'=>'About Page','type'=>'textarea','placeholder'=>'We bake in limited batches so every bite tastes like it came straight from the oven.'],
        ['key'=>'about_page_process2_title','label'=>'Process Card 2 Title','section'=>'About Page', 'type'=>'text',     'placeholder'=>'Hand Finish'],
        ['key'=>'about_page_process2_desc','label'=>'Process Card 2 Description','section'=>'About Page','type'=>'textarea','placeholder'=>'Each item is hand-finished with toppings, sauces, and a final quality check.'],
        ['key'=>'about_page_process3_title','label'=>'Process Card 3 Title','section'=>'About Page', 'type'=>'text',     'placeholder'=>'Pack & Deliver'],
        ['key'=>'about_page_process3_desc','label'=>'Process Card 3 Description','section'=>'About Page','type'=>'textarea','placeholder'=>'We package with care so your treats arrive photo-ready and fresh.'],
        ['key'=>'about_page_founder_title','label'=>'Founder Section Title','section'=>'About Page',  'type'=>'text',     'placeholder'=>'Meet the Maker'],
        ['key'=>'about_page_founder_desc','label'=>'Founder Section Description','section'=>'About Page','type'=>'textarea','placeholder'=>'Hi, I am Ayesha. I started Current Cravings after years of baking for family and friends. My goal is to make desserts that feel like a hug.'],
        ['key'=>'about_page_founder_tag1','label'=>'Founder Tag 1',      'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Founder'],
        ['key'=>'about_page_founder_tag2','label'=>'Founder Tag 2',      'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Recipe Developer'],
        ['key'=>'about_page_founder_tag3','label'=>'Founder Tag 3',      'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Taste Tester'],
        ['key'=>'about_page_founder_image','label'=>'Founder Image',     'section'=>'About Page',    'type'=>'image',    'placeholder'=>''],
        ['key'=>'about_page_founder_badge_title','label'=>'Founder Badge Title','section'=>'About Page','type'=>'text',  'placeholder'=>'Baked with love'],
        ['key'=>'about_page_founder_badge_text','label'=>'Founder Badge Text','section'=>'About Page','type'=>'text',    'placeholder'=>'Every single day'],
        ['key'=>'about_page_final_title','label'=>'Final CTA Title',     'section'=>'About Page',    'type'=>'text',     'placeholder'=>'Ready for a Sweet Moment?'],
        ['key'=>'about_page_final_desc','label'=>'Final CTA Description','section'=>'About Page',    'type'=>'textarea', 'placeholder'=>'Choose your favorites or let us surprise you with a curated box.'],
        ['key'=>'about_page_final_cta1_text','label'=>'Final CTA 1 Text','section'=>'About Page',   'type'=>'text',     'placeholder'=>'Shop the Menu'],
        ['key'=>'about_page_final_cta1_url','label'=>'Final CTA 1 URL',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'/menu'],
        ['key'=>'about_page_final_cta2_text','label'=>'Final CTA 2 Text','section'=>'About Page',   'type'=>'text',     'placeholder'=>'Gift a Box'],
        ['key'=>'about_page_final_cta2_url','label'=>'Final CTA 2 URL',  'section'=>'About Page',    'type'=>'text',     'placeholder'=>'/gift-a-box'],
        // Ã¢â€â‚¬Ã¢â€â‚¬ CONTACT PAGE
        ['key'=>'contact_heading',    'label'=>'Page Heading',          'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Get in Touch'],
        ['key'=>'contact_subheading', 'label'=>'Sub Heading',           'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'We\'d love to hear from you!'],
        ['key'=>'contact_email',      'label'=>'Contact Email',         'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'currentcravings4@gmail.com'],
        ['key'=>'contact_phone',      'label'=>'Contact Phone',         'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'+44 753 4738441'],
        ['key'=>'contact_address',    'label'=>'Address',               'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'King Street, Kettering NN16 8JF, United Kingdom'],
        ['key'=>'contact_hours',      'label'=>'Opening Hours',         'section'=>'Contact Page',  'type'=>'textarea', 'placeholder'=>"MonÃ¢â‚¬â€œSat: 9am Ã¢â‚¬â€œ 6pm\nSunday: Closed"],
        ['key'=>'contact_success_message',      'label'=>'Success Message',       'section'=>'Contact Page',  'type'=>'textarea', 'placeholder'=>'Your message has been sent! We\'ll get back to you within 24 hours.'],
        ['key'=>'contact_hero_badge',           'label'=>'Hero Badge',            'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'We\'d love to hear from you'],
        ['key'=>'contact_hero_title_prefix',    'label'=>'Hero Title Prefix',     'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Say'],
        ['key'=>'contact_hero_title_highlight', 'label'=>'Hero Title Highlight',  'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Hello'],
        ['key'=>'contact_hero_title_suffix',    'label'=>'Hero Title Suffix',     'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'to'],
        ['key'=>'contact_hero_quick_hours',     'label'=>'Hero Quick Hours',      'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'11:00 AM - 10:00 PM'],
        ['key'=>'contact_form_title',           'label'=>'Form Title',            'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Send a Message'],
        ['key'=>'contact_form_sub',             'label'=>'Form Sub Text',         'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'We reply within 24 hours - usually much faster!'],
        ['key'=>'contact_form_topic_label',     'label'=>'Topic Label',           'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'What\'s this about?'],
        ['key'=>'contact_form_success_title',   'label'=>'Success Title',         'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Message sent!'],
        ['key'=>'contact_form_error_title',     'label'=>'Error Title',           'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Please fix the following:'],
        ['key'=>'contact_form_submit',          'label'=>'Submit Button Text',    'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Send Message'],
        ['key'=>'contact_form_submit_note',     'label'=>'Submit Note',           'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Your info is safe with us'],
        ['key'=>'contact_form_first_name_label','label'=>'First Name Label',      'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'First Name *'],
        ['key'=>'contact_form_last_name_label', 'label'=>'Last Name Label',       'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Last Name *'],
        ['key'=>'contact_form_email_label',     'label'=>'Email Label',           'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Email Address *'],
        ['key'=>'contact_form_phone_label',     'label'=>'Phone Label',           'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Phone (optional)'],
        ['key'=>'contact_form_message_label',   'label'=>'Message Label',         'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Your Message *'],
        ['key'=>'contact_form_message_placeholder','label'=>'Message Placeholder','section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Tell us about your order or question...'],
        ['key'=>'contact_topic_custom_label',   'label'=>'Topic 1 Label',         'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Custom Order'],
        ['key'=>'contact_topic_general_label',  'label'=>'Topic 2 Label',         'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'General Query'],
        ['key'=>'contact_topic_delivery_label', 'label'=>'Topic 3 Label',         'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Delivery'],
        ['key'=>'contact_topic_other_label',    'label'=>'Topic 4 Label',         'section'=>'Contact Page',  'type'=>'text',     'placeholder'=>'Other'],
        ['key'=>'contact_topic_custom_placeholder',  'label'=>'Topic 1 Placeholder', 'section'=>'Contact Page','type'=>'text',     'placeholder'=>'Tell us the occasion, size, flavors, and event date...'],
        ['key'=>'contact_topic_general_placeholder', 'label'=>'Topic 2 Placeholder', 'section'=>'Contact Page','type'=>'text',     'placeholder'=>'Ask us anything about the menu, allergens, or ordering...'],
        ['key'=>'contact_topic_delivery_placeholder','label'=>'Topic 3 Placeholder', 'section'=>'Contact Page','type'=>'text',     'placeholder'=>'Include delivery date, address, and any special instructions...'],
        ['key'=>'contact_topic_other_placeholder',   'label'=>'Topic 4 Placeholder', 'section'=>'Contact Page','type'=>'text',     'placeholder'=>'Share any details that help us assist you...'],
        ['key'=>'contact_sidebar_location_title',    'label'=>'Location Card Title', 'section'=>'Contact Page','type'=>'text',     'placeholder'=>'Visit us in Kettering'],
        ['key'=>'contact_sidebar_location_address',  'label'=>'Location Card Address','section'=>'Contact Page','type'=>'text',     'placeholder'=>'12 Rose Street, Kettering, NN16 9NN'],
        ['key'=>'contact_sidebar_location_hours',    'label'=>'Location Card Hours', 'section'=>'Contact Page','type'=>'text',     'placeholder'=>'Mon - Sun: 11:00 AM - 10:00 PM'],
        ['key'=>'contact_sidebar_location_image',    'label'=>'Location Card Image', 'section'=>'Contact Page','type'=>'image',    'placeholder'=>''],
        ['key'=>'contact_sidebar_get_in_touch_title','label'=>'Sidebar Contact Title','section'=>'Contact Page','type'=>'text',     'placeholder'=>'Get in Touch'],
        ['key'=>'contact_sidebar_phone_sub',         'label'=>'Sidebar Phone Sub',   'section'=>'Contact Page','type'=>'text',     'placeholder'=>'Call or WhatsApp'],
        ['key'=>'contact_sidebar_email_sub',         'label'=>'Sidebar Email Sub',   'section'=>'Contact Page','type'=>'text',     'placeholder'=>'Reply within 24 hours'],
        ['key'=>'contact_sidebar_hours_sub',         'label'=>'Sidebar Hours Sub',   'section'=>'Contact Page','type'=>'text',     'placeholder'=>'Monday to Sunday'],
        ['key'=>'contact_sidebar_address_sub',       'label'=>'Sidebar Address Sub', 'section'=>'Contact Page','type'=>'text',     'placeholder'=>'12 Rose Street'],
        ['key'=>'contact_delivery_title',            'label'=>'Delivery Areas Title', 'section'=>'Contact Page','type'=>'text',    'placeholder'=>'Delivery Areas'],
        ['key'=>'contact_delivery_areas',            'label'=>'Delivery Areas List (comma-separated)', 'section'=>'Contact Page','type'=>'textarea','placeholder'=>'Kettering, Wellingborough, Rushden, Northampton, Irthlingborough, Corby, Brackley'],
        ['key'=>'contact_social_title',              'label'=>'Social Section Title', 'section'=>'Contact Page','type'=>'text',    'placeholder'=>'Find Us Online'],
        ['key'=>'contact_instagram_handle',          'label'=>'Instagram Handle',     'section'=>'Contact Page','type'=>'text',    'placeholder'=>'@currentcravings_uk'],
        ['key'=>'contact_tiktok_handle',             'label'=>'TikTok Handle',        'section'=>'Contact Page','type'=>'text',    'placeholder'=>'@currentcravings_uk'],
        ['key'=>'contact_pinterest_name',            'label'=>'Pinterest Name',       'section'=>'Contact Page','type'=>'text',    'placeholder'=>'Pinterest'],
        ['key'=>'contact_pinterest_handle',          'label'=>'Pinterest Handle',     'section'=>'Contact Page','type'=>'text',    'placeholder'=>'@current_cravings'],
        ['key'=>'contact_pinterest_url',             'label'=>'Pinterest URL',        'section'=>'Contact Page','type'=>'text',    'placeholder'=>'https://www.pinterest.com/'],
        ['key'=>'contact_faq_title',                 'label'=>'FAQ Section Title',    'section'=>'Contact Page','type'=>'text',    'placeholder'=>'Quick Answers'],
        ['key'=>'contact_faq_1_q',                   'label'=>'FAQ 1 Question',       'section'=>'Contact Page','type'=>'text',    'placeholder'=>'How far in advance should I order?'],
        ['key'=>'contact_faq_1_a',                   'label'=>'FAQ 1 Answer',         'section'=>'Contact Page','type'=>'textarea','placeholder'=>'At least 48 hours for standard orders, 5 days for custom cakes.'],
        ['key'=>'contact_faq_2_q',                   'label'=>'FAQ 2 Question',       'section'=>'Contact Page','type'=>'text',    'placeholder'=>'Are all products Halal?'],
        ['key'=>'contact_faq_2_a',                   'label'=>'FAQ 2 Answer',         'section'=>'Contact Page','type'=>'textarea','placeholder'=>'Yes! Every single ingredient we use is certified Halal.'],
        ['key'=>'contact_faq_3_q',                   'label'=>'FAQ 3 Question',       'section'=>'Contact Page','type'=>'text',    'placeholder'=>'Do you deliver outside Kettering?'],
        ['key'=>'contact_faq_3_a',                   'label'=>'FAQ 3 Answer',         'section'=>'Contact Page','type'=>'textarea','placeholder'=>'Yes, we cover Wellingborough, Rushden, Northampton and more.'],
        ['key'=>'contact_faq_4_q',                   'label'=>'FAQ 4 Question',       'section'=>'Contact Page','type'=>'text',    'placeholder'=>'Can I request a custom flavour?'],
        ['key'=>'contact_faq_4_a',                   'label'=>'FAQ 4 Answer',         'section'=>'Contact Page','type'=>'textarea','placeholder'=>'Absolutely! Use the form above and tell us your dream dessert.'],
        // Ã¢â€â‚¬Ã¢â€â‚¬ CHECKOUT PAGE
        ['key'=>'checkout_heading',   'label'=>'Checkout Heading',      'section'=>'Checkout Page', 'type'=>'text',     'placeholder'=>'Your Sweet Checkout'],
        ['key'=>'checkout_subheading','label'=>'Checkout Sub Heading',  'section'=>'Checkout Page', 'type'=>'textarea', 'placeholder'=>'Review your details and complete payment securely via Stripe Checkout.'],
        ['key'=>'checkout_note',      'label'=>'Checkout Note',         'section'=>'Checkout Page', 'type'=>'textarea', 'placeholder'=>'By continuing, you agree to our Terms & Conditions and will be redirected to Stripe Checkout to pay securely.'],
        ['key'=>'checkout_popup_title','label'=>'Success Popup Title',  'section'=>'Checkout Page', 'type'=>'text',     'placeholder'=>'Order Confirmed!'],
        ['key'=>'checkout_popup_sub', 'label'=>'Success Popup Message', 'section'=>'Checkout Page', 'type'=>'textarea', 'placeholder'=>'Thank you, :name! Your sweet treats are on their way.'],
        ['key'=>'checkout_popup_order_label','label'=>'Popup Order Label','section'=>'Checkout Page','type'=>'text',    'placeholder'=>'Order No.'],
        ['key'=>'checkout_popup_delivery_label','label'=>'Popup Delivery Label','section'=>'Checkout Page','type'=>'text','placeholder'=>'Delivery'],
        ['key'=>'checkout_popup_total_label','label'=>'Popup Total Label','section'=>'Checkout Page','type'=>'text',    'placeholder'=>'Total'],
        ['key'=>'checkout_popup_delivery_fallback','label'=>'Popup Delivery Fallback','section'=>'Checkout Page','type'=>'text','placeholder'=>'TBD'],
        ['key'=>'checkout_popup_button','label'=>'Success Popup Button', 'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Back to Home'],
        ['key'=>'checkout_step_shipping','label'=>'Step 1 Label',       'section'=>'Checkout Page', 'type'=>'text',     'placeholder'=>'Shipping'],
        ['key'=>'checkout_step_payment','label'=>'Step 2 Label',        'section'=>'Checkout Page', 'type'=>'text',     'placeholder'=>'Payment'],
        ['key'=>'checkout_step_review','label'=>'Step 3 Label',         'section'=>'Checkout Page', 'type'=>'text',     'placeholder'=>'Review'],
        ['key'=>'checkout_delivery_title','label'=>'Delivery Card Title','section'=>'Checkout Page', 'type'=>'text',     'placeholder'=>'Delivery Details'],
        ['key'=>'checkout_delivery_sub','label'=>'Delivery Card Subtitle','section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Tell us where to drop the sweetness.'],
        ['key'=>'checkout_first_name_label','label'=>'First Name Label', 'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'First Name'],
        ['key'=>'checkout_first_name_placeholder','label'=>'First Name Placeholder','section'=>'Checkout Page','type'=>'text','placeholder'=>'Aisha'],
        ['key'=>'checkout_last_name_label','label'=>'Last Name Label',   'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Last Name'],
        ['key'=>'checkout_last_name_placeholder','label'=>'Last Name Placeholder','section'=>'Checkout Page','type'=>'text','placeholder'=>'Khan'],
        ['key'=>'checkout_email_label','label'=>'Email Label',           'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Email Address'],
        ['key'=>'checkout_email_placeholder','label'=>'Email Placeholder','section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'you@example.com'],
        ['key'=>'checkout_phone_label','label'=>'Phone Label',           'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Phone Number'],
        ['key'=>'checkout_phone_placeholder','label'=>'Phone Placeholder','section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'+44 7700 900123'],
        ['key'=>'checkout_address_label','label'=>'Address Label',       'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Street Address'],
        ['key'=>'checkout_address_placeholder','label'=>'Address Placeholder','section'=>'Checkout Page','type'=>'text','placeholder'=>'123 Baker Street'],
        ['key'=>'checkout_city_label','label'=>'City Label',             'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'City / Town'],
        ['key'=>'checkout_city_placeholder','label'=>'City Placeholder', 'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'e.g. Kettering, London, Manchester'],
        ['key'=>'checkout_postcode_label','label'=>'Postcode Label',     'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Postcode'],
        ['key'=>'checkout_postcode_placeholder','label'=>'Postcode Placeholder','section'=>'Checkout Page','type'=>'text','placeholder'=>'NN16'],
        ['key'=>'checkout_datetime_title','label'=>'Date & Time Title',  'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Delivery Date & Time'],
        ['key'=>'checkout_datetime_sub','label'=>'Date & Time Subtitle', 'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Select your preferred delivery date and time.'],
        ['key'=>'checkout_date_label','label'=>'Date Label',             'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Choose Date'],
        ['key'=>'checkout_time_label','label'=>'Time Label',             'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Choose Time'],
        ['key'=>'checkout_time_slot_1','label'=>'Time Slot 1',           'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'9:00 AM - 11:00 AM'],
        ['key'=>'checkout_time_slot_2','label'=>'Time Slot 2',           'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'11:00 AM - 1:00 PM'],
        ['key'=>'checkout_time_slot_3','label'=>'Time Slot 3',           'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'1:00 PM - 3:00 PM'],
        ['key'=>'checkout_time_slot_4','label'=>'Time Slot 4',           'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'3:00 PM - 5:00 PM'],
        ['key'=>'checkout_time_slot_5','label'=>'Time Slot 5',           'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'5:00 PM - 7:00 PM'],
        ['key'=>'checkout_back_button','label'=>'Back Button Text',      'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Back'],
        ['key'=>'checkout_continue_payment_button','label'=>'Continue to Payment Button','section'=>'Checkout Page','type'=>'text','placeholder'=>'Continue to Payment'],
        ['key'=>'checkout_payment_title','label'=>'Payment Card Title',  'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Secure Payment'],
        ['key'=>'checkout_payment_sub','label'=>'Payment Card Subtitle', 'section'=>'Checkout Page', 'type'=>'textarea','placeholder'=>'We use Stripe Checkout so card details never touch your server. Stripe may show card, Apple Pay, Google Pay, and other supported methods automatically.'],
        ['key'=>'checkout_payment_redirect_note','label'=>'Payment Redirect Note','section'=>'Checkout Page','type'=>'textarea','placeholder'=>'After review, you will be redirected to Stripe\'s secure payment page to complete your order.'],
        ['key'=>'checkout_payment_badge_1','label'=>'Payment Badge 1',   'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Stripe-hosted'],
        ['key'=>'checkout_payment_badge_2','label'=>'Payment Badge 2',   'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Cards + wallets'],
        ['key'=>'checkout_payment_badge_3','label'=>'Payment Badge 3',   'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'PCI-safer flow'],
        ['key'=>'checkout_order_notes_label','label'=>'Order Notes Label','section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Order Notes'],
        ['key'=>'checkout_optional_text','label'=>'Optional Text',       'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'(optional)'],
        ['key'=>'checkout_order_notes_placeholder','label'=>'Order Notes Placeholder','section'=>'Checkout Page','type'=>'text','placeholder'=>'Allergies, special instructions, delivery notes'],
        ['key'=>'checkout_continue_review_button','label'=>'Continue to Review Button','section'=>'Checkout Page','type'=>'text','placeholder'=>'Continue to Review'],
        ['key'=>'checkout_review_title','label'=>'Review Card Title',    'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Review Your Order'],
        ['key'=>'checkout_review_sub','label'=>'Review Card Subtitle',   'section'=>'Checkout Page', 'type'=>'textarea','placeholder'=>'Everything look right? We will send you to secure Stripe Checkout for payment.'],
        ['key'=>'checkout_review_name_label','label'=>'Review Name Label','section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Name'],
        ['key'=>'checkout_review_email_label','label'=>'Review Email Label','section'=>'Checkout Page','type'=>'text',   'placeholder'=>'Email'],
        ['key'=>'checkout_review_address_label','label'=>'Review Address Label','section'=>'Checkout Page','type'=>'text','placeholder'=>'Address'],
        ['key'=>'checkout_review_delivery_label','label'=>'Review Delivery Label','section'=>'Checkout Page','type'=>'text','placeholder'=>'Delivery'],
        ['key'=>'checkout_review_payment_label','label'=>'Review Payment Label','section'=>'Checkout Page','type'=>'text','placeholder'=>'Payment'],
        ['key'=>'checkout_review_notes_label','label'=>'Review Notes Label','section'=>'Checkout Page','type'=>'text',    'placeholder'=>'Notes'],
        ['key'=>'checkout_continue_secure_button','label'=>'Continue to Secure Payment Button','section'=>'Checkout Page','type'=>'text','placeholder'=>'Continue to Secure Payment'],
        ['key'=>'checkout_review_payment_value','label'=>'Review Payment Value','section'=>'Checkout Page','type'=>'text','placeholder'=>'Stripe Checkout'],
        ['key'=>'checkout_promo_bar_text','label'=>'Top Promo Bar Text', 'section'=>'Checkout Page', 'type'=>'textarea', 'placeholder'=>'&pound;5.00 delivery & shipment charge applies to all orders.'],
        ['key'=>'checkout_order_summary_title','label'=>'Order Summary Title','section'=>'Checkout Page','type'=>'text', 'placeholder'=>'Your Order'],
        ['key'=>'checkout_order_summary_sub','label'=>'Order Summary Subtitle','section'=>'Checkout Page','type'=>'text', 'placeholder'=>'A sweet summary of your cart.'],
        ['key'=>'checkout_empty_cart_text','label'=>'Empty Cart Text',   'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Your cart is empty.'],
        ['key'=>'checkout_subtotal_label','label'=>'Subtotal Label',     'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Subtotal'],
        ['key'=>'checkout_delivery_label','label'=>'Delivery Label',     'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Delivery & Shipment'],
        ['key'=>'checkout_total_label','label'=>'Total Label',           'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Total'],
        ['key'=>'checkout_place_button','label'=>'Final Place Button',   'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Continue to Secure Payment'],
        ['key'=>'checkout_badge_secure','label'=>'Bottom Badge 1',       'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Secure'],
        ['key'=>'checkout_badge_encrypted','label'=>'Bottom Badge 2',    'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Encrypted'],
        ['key'=>'checkout_badge_delivery','label'=>'Bottom Badge 3',     'section'=>'Checkout Page', 'type'=>'text',    'placeholder'=>'Fast Delivery'],
        // -- PRIVACY POLICY PAGE
        ['key'=>'privacy_page_badge',     'label'=>'Privacy Badge',       'section'=>'Privacy Policy Page',     'type'=>'text',     'placeholder'=>'Legal'],
        ['key'=>'privacy_page_title',     'label'=>'Privacy Title',       'section'=>'Privacy Policy Page',     'type'=>'text',     'placeholder'=>'Privacy Policy'],
        ['key'=>'privacy_page_subtitle',  'label'=>'Privacy Subtitle',    'section'=>'Privacy Policy Page',     'type'=>'text',     'placeholder'=>'Last updated: January 2025'],
        ['key'=>'privacy_page_body_html', 'label'=>'Privacy Body HTML',   'section'=>'Privacy Policy Page',     'type'=>'textarea', 'placeholder'=>'Paste full HTML content for privacy policy body card here.'],
        // -- TERMS PAGE
        ['key'=>'terms_page_badge',       'label'=>'Terms Badge',         'section'=>'Terms of Service Page',   'type'=>'text',     'placeholder'=>'Legal'],
        ['key'=>'terms_page_title',       'label'=>'Terms Title',         'section'=>'Terms of Service Page',   'type'=>'text',     'placeholder'=>'Terms of Service'],
        ['key'=>'terms_page_subtitle',    'label'=>'Terms Subtitle',      'section'=>'Terms of Service Page',   'type'=>'text',     'placeholder'=>'Last updated: January 2025'],
        ['key'=>'terms_page_body_html',   'label'=>'Terms Body HTML',     'section'=>'Terms of Service Page',   'type'=>'textarea', 'placeholder'=>'Paste full HTML content for terms page body card here.'],
        // -- REFUNDS PAGE
        ['key'=>'refunds_page_badge',     'label'=>'Refunds Badge',       'section'=>'Refunds & Returns Page',  'type'=>'text',     'placeholder'=>'Legal'],
        ['key'=>'refunds_page_title',     'label'=>'Refunds Title',       'section'=>'Refunds & Returns Page',  'type'=>'text',     'placeholder'=>'Refunds & Returns Policy'],
        ['key'=>'refunds_page_subtitle',  'label'=>'Refunds Subtitle',    'section'=>'Refunds & Returns Page',  'type'=>'text',     'placeholder'=>'Last updated: January 2025'],
        ['key'=>'refunds_page_body_html', 'label'=>'Refunds Body HTML',   'section'=>'Refunds & Returns Page',  'type'=>'textarea', 'placeholder'=>'Paste full HTML content for refunds & returns page body card here.'],
        // -- ALLERGEN PAGE
        ['key'=>'allergen_page_badge',    'label'=>'Allergen Badge',      'section'=>'Allergen Info Page',      'type'=>'text',     'placeholder'=>'Health & Safety'],
        ['key'=>'allergen_page_title',    'label'=>'Allergen Title',      'section'=>'Allergen Info Page',      'type'=>'text',     'placeholder'=>'Allergen Information'],
        ['key'=>'allergen_page_subtitle', 'label'=>'Allergen Subtitle',   'section'=>'Allergen Info Page',      'type'=>'text',     'placeholder'=>'Your safety is our priority'],
        ['key'=>'allergen_page_body_html','label'=>'Allergen Body HTML',  'section'=>'Allergen Info Page',      'type'=>'textarea', 'placeholder'=>'Paste full HTML content for allergen page body card here.'],
        // -- DELIVERY PAGE
        ['key'=>'delivery_page_badge',    'label'=>'Delivery Badge',      'section'=>'Delivery & Shipping Page', 'type'=>'text',     'placeholder'=>'Shipping Info'],
        ['key'=>'delivery_page_title',    'label'=>'Delivery Title',      'section'=>'Delivery & Shipping Page', 'type'=>'text',     'placeholder'=>'Delivery & Shipping'],
        ['key'=>'delivery_page_subtitle', 'label'=>'Delivery Subtitle',   'section'=>'Delivery & Shipping Page', 'type'=>'text',     'placeholder'=>'Fresh to your door, every time'],
        ['key'=>'delivery_page_body_html','label'=>'Delivery Body HTML',  'section'=>'Delivery & Shipping Page', 'type'=>'textarea', 'placeholder'=>'Paste full HTML content for delivery & shipping page body card here.'],
        ['key'=>'footer_menu_title',      'label'=>'Footer Menu Column Title',    'section'=>'General', 'type'=>'text', 'placeholder'=>'Menu'],
        ['key'=>'footer_menu_link1_text', 'label'=>'Footer Menu Link 1 Text',     'section'=>'General', 'type'=>'text', 'placeholder'=>'Brownies'],
        ['key'=>'footer_menu_link1_url',  'label'=>'Footer Menu Link 1 URL',      'section'=>'General', 'type'=>'text', 'placeholder'=>'/menu/brownies'],
        ['key'=>'footer_menu_link2_text', 'label'=>'Footer Menu Link 2 Text',     'section'=>'General', 'type'=>'text', 'placeholder'=>'Cookies'],
        ['key'=>'footer_menu_link2_url',  'label'=>'Footer Menu Link 2 URL',      'section'=>'General', 'type'=>'text', 'placeholder'=>'/menu/cookies'],
        ['key'=>'footer_menu_link3_text', 'label'=>'Footer Menu Link 3 Text',     'section'=>'General', 'type'=>'text', 'placeholder'=>'Tres Leches'],
        ['key'=>'footer_menu_link3_url',  'label'=>'Footer Menu Link 3 URL',      'section'=>'General', 'type'=>'text', 'placeholder'=>'/menu/tres-leches'],
        ['key'=>'footer_menu_link4_text', 'label'=>'Footer Menu Link 4 Text',     'section'=>'General', 'type'=>'text', 'placeholder'=>'Drinks'],
        ['key'=>'footer_menu_link4_url',  'label'=>'Footer Menu Link 4 URL',      'section'=>'General', 'type'=>'text', 'placeholder'=>'/menu/drinks'],
        ['key'=>'footer_menu_link5_text', 'label'=>'Footer Menu Link 5 Text',     'section'=>'General', 'type'=>'text', 'placeholder'=>'Gift Boxes'],
        ['key'=>'footer_menu_link5_url',  'label'=>'Footer Menu Link 5 URL',      'section'=>'General', 'type'=>'text', 'placeholder'=>'/menu/boxes'],
        ['key'=>'footer_info_title',      'label'=>'Footer Info Column Title',    'section'=>'General', 'type'=>'text', 'placeholder'=>'Info'],
        ['key'=>'footer_info_link1_text', 'label'=>'Footer Info Link 1 Text',     'section'=>'General', 'type'=>'text', 'placeholder'=>'About Us'],
        ['key'=>'footer_info_link1_url',  'label'=>'Footer Info Link 1 URL',      'section'=>'General', 'type'=>'text', 'placeholder'=>'/about'],
        ['key'=>'footer_info_link2_text', 'label'=>'Footer Info Link 2 Text',     'section'=>'General', 'type'=>'text', 'placeholder'=>'Allergen Info'],
        ['key'=>'footer_info_link2_url',  'label'=>'Footer Info Link 2 URL',      'section'=>'General', 'type'=>'text', 'placeholder'=>'/allergen-info'],
        ['key'=>'footer_info_link3_text', 'label'=>'Footer Info Link 3 Text',     'section'=>'General', 'type'=>'text', 'placeholder'=>'Delivery & Shipping'],
        ['key'=>'footer_info_link3_url',  'label'=>'Footer Info Link 3 URL',      'section'=>'General', 'type'=>'text', 'placeholder'=>'/delivery-shipping'],
        ['key'=>'footer_info_link4_text', 'label'=>'Footer Info Link 4 Text',     'section'=>'General', 'type'=>'text', 'placeholder'=>'Contact Us'],
        ['key'=>'footer_info_link4_url',  'label'=>'Footer Info Link 4 URL',      'section'=>'General', 'type'=>'text', 'placeholder'=>'/contact'],
        ['key'=>'footer_legal_link1_text','label'=>'Footer Legal Link 1 Text',    'section'=>'General', 'type'=>'text', 'placeholder'=>'Privacy Policy'],
        ['key'=>'footer_legal_link1_url', 'label'=>'Footer Legal Link 1 URL',     'section'=>'General', 'type'=>'text', 'placeholder'=>'/privacy-policy'],
        ['key'=>'footer_legal_link2_text','label'=>'Footer Legal Link 2 Text',    'section'=>'General', 'type'=>'text', 'placeholder'=>'Terms of Service'],
        ['key'=>'footer_legal_link2_url', 'label'=>'Footer Legal Link 2 URL',     'section'=>'General', 'type'=>'text', 'placeholder'=>'/terms-of-service'],
        ['key'=>'footer_legal_link3_text','label'=>'Footer Legal Link 3 Text',    'section'=>'General', 'type'=>'text', 'placeholder'=>'Refund Policy'],
        ['key'=>'footer_legal_link3_url', 'label'=>'Footer Legal Link 3 URL',     'section'=>'General', 'type'=>'text', 'placeholder'=>'/refunds-returns'],
        ['key'=>'footer_legal_link4_text','label'=>'Footer Legal Link 4 Text',    'section'=>'General', 'type'=>'text', 'placeholder'=>'Allergen Info'],
        ['key'=>'footer_legal_link4_url', 'label'=>'Footer Legal Link 4 URL',     'section'=>'General', 'type'=>'text', 'placeholder'=>'/allergen-info'],
        ['key'=>'footer_legal_link5_text','label'=>'Footer Legal Link 5 Text',    'section'=>'General', 'type'=>'text', 'placeholder'=>'Delivery & Shipping'],
        ['key'=>'footer_legal_link5_url', 'label'=>'Footer Legal Link 5 URL',     'section'=>'General', 'type'=>'text', 'placeholder'=>'/delivery-shipping'],
        ['key'=>'footer_pinterest_url',   'label'=>'Footer Pinterest URL',         'section'=>'General', 'type'=>'text', 'placeholder'=>'https://www.pinterest.com/'],
        ['key'=>'footer_copy',            'label'=>'Footer Copyright Line',        'section'=>'General', 'type'=>'text', 'placeholder'=>'(c) 2024 Current Cravings - King Street, Kettering NN16 8JF'],
        ['key'=>'footer_stamp_text',      'label'=>'Footer Stamp Text',            'section'=>'General', 'type'=>'text', 'placeholder'=>'Baked for Every Craving.'],
        // GENERAL
        ['key'=>'site_tagline',       'label'=>'Site Tagline',          'section'=>'General',       'type'=>'text',     'placeholder'=>'Freshly Baked Happiness'],
        ['key'=>'logo_image',         'label'=>'Logo Image',            'section'=>'General',       'type'=>'image',    'placeholder'=>''],
        ['key'=>'footer_text',        'label'=>'Footer Description',    'section'=>'General',       'type'=>'textarea', 'placeholder'=>'Current Cravings is a home bakery in Kettering serving freshly crafted desserts - no preservatives, no shortcuts, just pure happiness in every bite.'],
        ['key'=>'whatsapp_number',    'label'=>'WhatsApp Number',       'section'=>'General',       'type'=>'text',     'placeholder'=>'+447534738441'],
        ['key'=>'instagram_url',      'label'=>'Instagram URL',         'section'=>'General',       'type'=>'text',     'placeholder'=>'https://instagram.com/current_cravings'],
        ['key'=>'tiktok_url',         'label'=>'TikTok URL',            'section'=>'General',       'type'=>'text',     'placeholder'=>'https://tiktok.com/@cravings_bakery'],
        ['key'=>'stock_guard_enabled','label'=>'Enable Out-of-Stock Guard','section'=>'General',    'type'=>'checkbox', 'placeholder'=>'1'],
    ];

    private function defaultFields(): array
    {
        return array_merge($this->defaults, $this->seoFields());
    }

    private function seoFields(): array
    {
        return [
            ['key' => 'home_seo_title', 'label' => 'SEO Meta Title', 'section' => 'Home - Hero', 'type' => 'text', 'placeholder' => 'Current Cravings | Freshly Baked Happiness'],
            ['key' => 'home_seo_description', 'label' => 'SEO Meta Description', 'section' => 'Home - Hero', 'type' => 'textarea', 'placeholder' => 'Homemade desserts in Kettering: cookies, brownies, tres leches, and celebration cakes baked fresh daily.'],
            ['key' => 'home_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'Home - Hero', 'type' => 'text', 'placeholder' => '/'],
            ['key' => 'home_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'Home - Hero', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'menu_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'Menu Page', 'type' => 'text', 'placeholder' => 'Menu | Current Cravings'],
            ['key' => 'menu_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'Menu Page', 'type' => 'textarea', 'placeholder' => 'Explore our full dessert menu including cookies, brownies, tres leches, drinks, and gift boxes.'],
            ['key' => 'menu_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'Menu Page', 'type' => 'text', 'placeholder' => '/menu'],
            ['key' => 'menu_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'Menu Page', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'about_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'About Page', 'type' => 'text', 'placeholder' => 'About Us | Current Cravings'],
            ['key' => 'about_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'About Page', 'type' => 'textarea', 'placeholder' => 'Learn the story behind Current Cravings and our small-batch baking process.'],
            ['key' => 'about_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'About Page', 'type' => 'text', 'placeholder' => '/about'],
            ['key' => 'about_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'About Page', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'contact_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'Contact Page', 'type' => 'text', 'placeholder' => 'Contact | Current Cravings'],
            ['key' => 'contact_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'Contact Page', 'type' => 'textarea', 'placeholder' => 'Get in touch with Current Cravings for custom orders, deliveries, and general inquiries.'],
            ['key' => 'contact_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'Contact Page', 'type' => 'text', 'placeholder' => '/contact'],
            ['key' => 'contact_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'Contact Page', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'checkout_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'Checkout Page', 'type' => 'text', 'placeholder' => 'Checkout | Current Cravings'],
            ['key' => 'checkout_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'Checkout Page', 'type' => 'textarea', 'placeholder' => 'Secure checkout for your dessert order with fast delivery options.'],
            ['key' => 'checkout_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'Checkout Page', 'type' => 'text', 'placeholder' => '/checkout'],
            ['key' => 'checkout_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'Checkout Page', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'privacy_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'Privacy Policy Page', 'type' => 'text', 'placeholder' => 'Privacy Policy | Current Cravings'],
            ['key' => 'privacy_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'Privacy Policy Page', 'type' => 'textarea', 'placeholder' => 'Read how Current Cravings collects and protects your personal information.'],
            ['key' => 'privacy_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'Privacy Policy Page', 'type' => 'text', 'placeholder' => '/privacy-policy'],
            ['key' => 'privacy_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'Privacy Policy Page', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'terms_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'Terms of Service Page', 'type' => 'text', 'placeholder' => 'Terms of Service | Current Cravings'],
            ['key' => 'terms_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'Terms of Service Page', 'type' => 'textarea', 'placeholder' => 'Review the terms and conditions for using the Current Cravings website and services.'],
            ['key' => 'terms_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'Terms of Service Page', 'type' => 'text', 'placeholder' => '/terms-of-service'],
            ['key' => 'terms_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'Terms of Service Page', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'refunds_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'Refunds & Returns Page', 'type' => 'text', 'placeholder' => 'Refund Policy | Current Cravings'],
            ['key' => 'refunds_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'Refunds & Returns Page', 'type' => 'textarea', 'placeholder' => 'Learn our refunds, returns, and replacement policy for bakery orders.'],
            ['key' => 'refunds_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'Refunds & Returns Page', 'type' => 'text', 'placeholder' => '/refunds-returns'],
            ['key' => 'refunds_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'Refunds & Returns Page', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'allergen_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'Allergen Info Page', 'type' => 'text', 'placeholder' => 'Allergen Information | Current Cravings'],
            ['key' => 'allergen_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'Allergen Info Page', 'type' => 'textarea', 'placeholder' => 'Important allergen guidance for all Current Cravings products.'],
            ['key' => 'allergen_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'Allergen Info Page', 'type' => 'text', 'placeholder' => '/allergen-info'],
            ['key' => 'allergen_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'Allergen Info Page', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'delivery_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'Delivery & Shipping Page', 'type' => 'text', 'placeholder' => 'Delivery & Shipping | Current Cravings'],
            ['key' => 'delivery_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'Delivery & Shipping Page', 'type' => 'textarea', 'placeholder' => 'Delivery zones, order timing, and shipping details for Current Cravings.'],
            ['key' => 'delivery_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'Delivery & Shipping Page', 'type' => 'text', 'placeholder' => '/delivery-shipping'],
            ['key' => 'delivery_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'Delivery & Shipping Page', 'type' => 'checkbox', 'placeholder' => '1'],

            ['key' => 'blog_page_seo_title', 'label' => 'SEO Meta Title', 'section' => 'General', 'type' => 'text', 'placeholder' => 'Blog | Current Cravings'],
            ['key' => 'blog_page_seo_description', 'label' => 'SEO Meta Description', 'section' => 'General', 'type' => 'textarea', 'placeholder' => 'Read baking tips, recipes, and dessert stories from Current Cravings.'],
            ['key' => 'blog_page_seo_canonical', 'label' => 'SEO Canonical URL', 'section' => 'General', 'type' => 'text', 'placeholder' => '/blog'],
            ['key' => 'blog_page_seo_index', 'label' => 'SEO Allow Indexing', 'section' => 'General', 'type' => 'checkbox', 'placeholder' => '1'],
        ];
    }

    public function index()
    {
        $defaults = $this->defaultFields();
        $hasPlaceholderColumn = Schema::hasColumn('site_contents', 'placeholder');

        foreach ($defaults as $d) {
            $createData = array_merge(
                Arr::only($d, ['label', 'section', 'type']),
                ['value' => null]
            );

            if ($hasPlaceholderColumn) {
                $createData['placeholder'] = $d['placeholder'] ?? null;
            }

            SiteContent::firstOrCreate(
                ['key' => $d['key']],
                $createData
            );
        }

        // Re-sync labels/placeholders
        foreach ($defaults as $d) {
            $updateData = [
                'label'   => $d['label'],
                'section' => $d['section'],
                'type'    => $d['type'],
            ];

            if ($hasPlaceholderColumn) {
                $updateData['placeholder'] = $d['placeholder'] ?? null;
            }

            SiteContent::where('key', $d['key'])->update($updateData);
        }

        $contents = SiteContent::orderByRaw("FIELD(section,'Home - Hero','Home - Hero Cards','Home - Banner','Home - About','Menu Page','About Page','Contact Page','Checkout Page','Privacy Policy Page','Terms of Service Page','Refunds & Returns Page','Allergen Info Page','Delivery & Shipping Page','General')")
            ->orderBy('id')
            ->get()
            ->groupBy('section');

        // Keep placeholder hints available in UI even when the database
        // does not yet have the placeholder column.
        if (! $hasPlaceholderColumn) {
            $placeholderMap = collect($defaults)->pluck('placeholder', 'key');
            $contents = $contents->map(function ($items) use ($placeholderMap) {
                return $items->map(function ($item) use ($placeholderMap) {
                    $item->placeholder = $placeholderMap->get($item->key);
                    return $item;
                });
            });
        }

        $sections = array_unique(array_column($defaults, 'section'));

        return view('admin.site-content.index', compact('contents', 'sections'));
    }

    public function update(Request $request)
    {
        $defaults = $this->defaultFields();
        $fields = $request->except(['_token', '_method']);
        $activeSection = (string) $request->input('_active_tab', '');

        $checkboxKeys = collect($defaults)
            ->when($activeSection !== '', fn ($c) => $c->where('section', $activeSection))
            ->where('type', 'checkbox')
            ->pluck('key')
            ->all();

        foreach ($checkboxKeys as $checkboxKey) {
            $fields[$checkboxKey] = $request->boolean($checkboxKey) ? '1' : '0';
        }

        foreach ($fields as $key => $value) {
            if (str_starts_with($key, '_file_')) continue;
            SiteContent::where('key', $key)->update(['value' => $value]);
        }

        foreach ($defaults as $d) {
            if ($d['type'] !== 'image') continue;
            $fileKey = '_file_' . $d['key'];
            if ($request->hasFile($fileKey)) {
                $path = $request->file($fileKey)->store('site-content', 'public');
                SiteContent::where('key', $d['key'])->update(['value' => $path]);
            }
        }

        $tab = $request->input('_active_tab', '');
        return back()->with('success', 'Content updated!')->withInput(['_active_tab' => $tab]);
    }
}




