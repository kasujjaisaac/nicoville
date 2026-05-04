<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nicoville Charity Organisation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #15211d;
            --soft-ink: #43524d;
            --muted: #6f7d78;
            --line: #dbe6e0;
            --green: #0f6f4d;
            --green-dark: #073f31;
            --teal: #0b7f7a;
            --gold: #d99b2b;
            --coral: #c9543d;
            --paper: #f8f5ee;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--ink);
            font-family: 'Quicksand', Arial, Helvetica, sans-serif;
            font-size: 16px;
            background: var(--paper);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 10px clamp(18px, 5vw, 76px);
            color: rgba(255, 255, 255, .92);
            background: var(--green-dark);
            font-size: 13px;
            font-weight: 700;
        }

        .top-group,
        .contact-list,
        .status-pill {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .contact-list {
            flex-wrap: wrap;
        }

        .top-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 24px;
        }

        .top-icon {
            width: 16px;
            height: 16px;
            flex: 0 0 16px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        .status-pill {
            gap: 8px;
            padding: 6px 10px;
            border: 1px solid rgba(255, 255, 255, .28);
            border-radius: 0;
            background: rgba(255, 255, 255, .1);
            white-space: nowrap;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 0;
            background: #69d585;
            box-shadow: 0 0 0 4px rgba(105, 213, 133, .15);
        }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 20;
            display: grid;
            grid-template-columns: minmax(180px, 1fr) auto minmax(180px, 1fr);
            align-items: center;
            gap: 28px;
            padding: 12px clamp(18px, 5vw, 76px);
            border-bottom: 1px solid rgba(21, 33, 29, .08);
            background: var(--white);
            backdrop-filter: blur(14px);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            min-width: max-content;
            justify-self: start;
        }

        .brand-mark {
            width: auto;
            max-width: 260px;
            height: 82px;
            border-radius: 0;
            object-fit: contain;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: center;
            justify-self: center;
            gap: clamp(14px, 2.5vw, 30px);
            color: var(--soft-ink);
            font-size: 15px;
            font-weight: 800;
        }

        .nav-item {
            position: relative;
        }

        .nav a,
        .nav-trigger {
            display: inline-flex;
            align-items: center;
            min-height: 42px;
            padding: 10px 0;
            border: 0;
            color: inherit;
            background: transparent;
            font: inherit;
            cursor: pointer;
        }

        .nav a:hover,
        .nav-trigger:hover {
            color: var(--green);
        }

        .nav .donate-link,
        .nav .donate-link .nav-trigger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 18px;
            border-radius: 0;
            color: var(--white);
            background: var(--coral);
            box-shadow: 0 12px 30px rgba(201, 84, 61, .22);
        }

        .submenu {
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            z-index: 30;
            display: grid;
            min-width: 210px;
            padding: 8px;
            border: 1px solid var(--line);
            background: var(--white);
            box-shadow: 0 18px 42px rgba(21, 33, 29, .13);
            opacity: 0;
            pointer-events: none;
            transform: translateY(8px);
            transition: opacity .18s ease, transform .18s ease;
        }

        .nav-item:hover .submenu,
        .nav-item:focus-within .submenu {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .submenu a {
            min-height: 40px;
            padding: 0 12px;
            color: var(--soft-ink);
            white-space: nowrap;
        }

        .submenu a:hover {
            color: var(--white);
            background: var(--green);
        }

        .hero-slider {
            position: relative;
            overflow: hidden;
            min-height: 780px;
            color: var(--white);
            background: var(--green-dark);
        }

        .slide {
            position: absolute;
            inset: 0;
            display: block;
            min-height: 100%;
            padding: clamp(44px, 6vw, 72px) clamp(18px, 5vw, 76px) 88px;
            opacity: 0;
            visibility: hidden;
            transition: opacity .7s ease, visibility .7s ease;
        }

        .slide.is-active {
            opacity: 1;
            visibility: visible;
        }

        .slide::before {
            position: absolute;
            inset: 0;
            content: "";
            background:
                linear-gradient(90deg, rgba(7, 63, 49, .92) 0%, rgba(7, 63, 49, .74) 42%, rgba(7, 63, 49, .25) 100%),
                var(--hero-image);
            background-position: center;
            background-size: cover;
            transform: scale(1.02);
        }

        .slide::after {
            position: absolute;
            inset: auto 0 0;
            height: 34%;
            content: "";
            background: linear-gradient(0deg, rgba(7, 63, 49, .72), transparent);
        }

        .slide-content {
            position: relative;
            z-index: 1;
            width: min(720px, 100%);
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(340px, 460px);
            gap: clamp(28px, 4vw, 56px);
            align-items: center;
            min-height: 620px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 18px;
            color: #ffe0a4;
            font-size: 14px;
            font-weight: 900;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        .eyebrow::before {
            width: 36px;
            height: 2px;
            content: "";
            background: var(--gold);
        }

        h1 {
            margin: 0;
            max-width: 700px;
            font-size: clamp(30px, 4.2vw, 50px);
            line-height: 1.08;
            letter-spacing: 0;
        }

        .lead {
            max-width: 620px;
            margin: 22px 0 0;
            color: rgba(255, 255, 255, .84);
            font-size: clamp(17px, 1.8vw, 20px);
            line-height: 1.58;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 34px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 0 22px;
            border: 1px solid transparent;
            border-radius: 0;
            font-size: 15px;
            font-weight: 900;
        }

        .button.primary {
            color: var(--white);
            background: var(--coral);
            box-shadow: 0 14px 34px rgba(201, 84, 61, .26);
        }

        .button.secondary {
            color: var(--white);
            border-color: rgba(255, 255, 255, .44);
            background: rgba(255, 255, 255, .1);
        }

        .slider-controls {
            position: absolute;
            left: clamp(18px, 5vw, 76px);
            bottom: clamp(24px, 5vw, 54px);
            z-index: 3;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .slider-dot {
            width: 44px;
            height: 4px;
            border: 0;
            border-radius: 0;
            background: rgba(255, 255, 255, .38);
            cursor: pointer;
        }

        .slider-dot.is-active {
            background: var(--gold);
        }

        .impact-section {
            display: grid;
            grid-template-columns: minmax(320px, .98fr) minmax(320px, 1fr);
            gap: clamp(30px, 6vw, 76px);
            align-items: center;
            padding: clamp(38px, 5vw, 62px) clamp(18px, 5vw, 76px);
            background: #f7f4f3;
        }

        .impact-images {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            min-height: clamp(340px, 36vw, 500px);
        }

        .impact-image {
            position: relative;
            overflow: hidden;
            margin: 0;
            background: var(--line);
        }

        .impact-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .impact-rotating-image {
            position: absolute;
            inset: 0;
            opacity: 0;
            transform: scale(1.04);
            transition: opacity .75s ease, transform 1.2s ease;
        }

        .impact-rotating-image.is-active {
            opacity: 1;
            transform: scale(1);
        }

        .impact-image-dots {
            position: absolute;
            right: 12px;
            bottom: 12px;
            z-index: 2;
            display: flex;
            gap: 6px;
        }

        .impact-image-dots span {
            width: 8px;
            height: 8px;
            border: 1px solid rgba(255, 255, 255, .9);
            background: rgba(255, 255, 255, .26);
        }

        .impact-image-dots span.is-active {
            background: var(--white);
        }

        .impact-copy {
            display: grid;
            justify-items: center;
            text-align: center;
        }

        .impact-copy h2 {
            max-width: 760px;
            margin: 0;
            color: #302c29;
            font-size: clamp(24px, 3vw, 38px);
            line-height: 1.22;
            letter-spacing: 0;
        }

        .impact-copy .green-text {
            color: #00663f;
        }

        .impact-copy .green-mark {
            display: inline-block;
            padding: 0 8px 2px;
            color: var(--white);
            background: #007348;
            line-height: 1.02;
        }

        .program-cards {
            display: grid;
            width: 100%;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: clamp(28px, 4vw, 46px);
        }

        .program-card {
            display: grid;
            align-content: space-between;
            min-height: 150px;
            aspect-ratio: 1;
            padding: 20px;
            border: 1px solid rgba(0, 102, 63, .2);
            background: var(--white);
            box-shadow: 0 16px 38px rgba(21, 33, 29, .08);
            text-align: left;
        }

        .program-card h3 {
            margin: 0;
            color: #302c29;
            font-size: clamp(16px, 1.45vw, 20px);
            line-height: 1.22;
        }

        .program-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            justify-self: start;
            min-height: 38px;
            margin-top: 22px;
            padding: 0 16px;
            background: #007348;
            color: var(--white);
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .causes-section {
            padding: clamp(50px, 6vw, 82px) clamp(18px, 5vw, 76px);
            background: var(--white);
        }

        .causes-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 28px;
        }

        .causes-heading h2 {
            max-width: 660px;
            margin: 0;
            color: #24211f;
            font-size: clamp(30px, 4vw, 48px);
            line-height: 1.08;
        }

        .causes-heading p {
            max-width: 430px;
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
        }

        .causes-carousel {
            position: relative;
            overflow: hidden;
        }

        .causes-track {
            display: flex;
            gap: 26px;
            transition: transform .55s ease;
            will-change: transform;
        }

        .cause-card {
            position: relative;
            display: grid;
            min-width: calc((100% - 52px) / 3);
            grid-template-columns: minmax(0, .9fr) minmax(150px, 1fr);
            gap: 22px;
            align-items: center;
            min-height: 240px;
            padding: clamp(18px, 2vw, 28px);
            overflow: hidden;
            background: #191919;
            color: var(--white);
        }

        .cause-card::before {
            position: absolute;
            right: 38%;
            bottom: 28px;
            width: 120px;
            height: 120px;
            content: "";
            border: 8px solid rgba(255, 255, 255, .04);
            border-radius: 999px;
        }

        .cause-content {
            position: relative;
            z-index: 1;
        }

        .cause-kicker {
            display: block;
            margin-bottom: 18px;
            color: #ffb313;
            font-size: clamp(18px, 2vw, 26px);
            font-weight: 900;
            font-style: italic;
        }

        .cause-card h3 {
            margin: 0;
            font-size: clamp(21px, 2vw, 28px);
            line-height: 1.28;
        }

        .cause-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            margin-top: 24px;
            padding: 0 20px;
            border-radius: 6px;
            background: #ff4d24;
            color: var(--white);
            font-size: 18px;
            font-weight: 900;
        }

        .cause-link.gold {
            background: #ffb313;
        }

        .cause-image {
            position: relative;
            z-index: 1;
            min-height: 180px;
            overflow: hidden;
        }

        .cause-image img {
            width: 100%;
            height: 100%;
            min-height: 180px;
            object-fit: cover;
        }

        .cause-arrow {
            position: absolute;
            top: 50%;
            z-index: 3;
            display: grid;
            width: 48px;
            height: 48px;
            place-items: center;
            border: 0;
            border-radius: 999px;
            background: #007348;
            color: var(--white);
            cursor: pointer;
            transform: translateY(-50%);
            box-shadow: 0 12px 28px rgba(21, 33, 29, .18);
        }

        .cause-arrow.prev {
            left: 12px;
        }

        .cause-arrow.next {
            right: 12px;
        }

        .cause-arrow svg {
            width: 24px;
            height: 24px;
            stroke: currentColor;
            stroke-width: 2.6;
            fill: none;
        }

        .cause-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 26px;
        }

        .cause-dot {
            width: 36px;
            height: 5px;
            border: 0;
            background: #d7dedb;
            cursor: pointer;
        }

        .cause-dot.is-active {
            background: #007348;
        }

        .cause-dot.is-hidden {
            display: none;
        }

        .donation-card {
            position: relative;
            z-index: 2;
            justify-self: end;
            width: min(100%, 340px);
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, .68);
            background: rgba(255, 255, 255, .96);
            color: #334d45;
            box-shadow: 0 28px 80px rgba(7, 63, 49, .32);
        }

        .donation-steps {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 8px;
        }

        .step-dot {
            width: 14px;
            height: 14px;
            border: 2px solid #b7bbb9;
            background: var(--white);
        }

        .step-dot.active {
            border-color: #6e9d8d;
            background: #6e9d8d;
            box-shadow: inset 0 0 0 4px var(--white);
        }

        .step-line {
            width: 18px;
            height: 2px;
            background: #b7bbb9;
        }

        .donation-toggle {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: min(260px, 100%);
            margin: 0 auto 8px;
            padding: 3px;
            background: #6e9d8d;
            border-radius: 4px;
        }

        .toggle-option {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 26px;
            border: 0;
            border-radius: 3px;
            color: #203730;
            background: transparent;
            font: inherit;
            font-size: 11px;
            font-weight: 900;
            cursor: pointer;
            transition: background .18s ease, color .18s ease, transform .18s ease, box-shadow .18s ease;
        }

        .toggle-option:hover,
        .toggle-option:focus-visible {
            color: var(--white);
            transform: translateY(-1px);
            outline: 0;
        }

        .toggle-option.active,
        .toggle-option[aria-pressed="true"] {
            background: var(--white);
            color: #203730;
            box-shadow: 0 4px 12px rgba(22, 64, 52, .16);
        }

        .toggle-heart {
            margin-right: 7px;
            color: #ff4a42;
        }

        .donation-note {
            position: relative;
            width: min(280px, 100%);
            margin: 0 auto 10px;
            padding: 7px 9px;
            background: #e9c5c4;
            color: #4a2b2b;
            text-align: center;
            font-size: 12px;
            line-height: 1.35;
        }

        .donation-note::before {
            position: absolute;
            top: -10px;
            left: 71%;
            width: 20px;
            height: 20px;
            content: "";
            background: #e9c5c4;
            transform: rotate(45deg);
        }

        .donation-title {
            margin: 0 0 8px;
            color: #3c5b51;
            font-size: 14px;
            font-weight: 500;
            line-height: 1.25;
            text-align: center;
        }

        .amount-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
            margin-bottom: 6px;
            container-type: inline-size;
        }

        .amount-button {
            min-width: 0;
            min-height: 40px;
            padding: 0 4px;
            border: 1px solid #e8bbbb;
            color: #b45b5d;
            background: rgba(255, 255, 255, .72);
            font: inherit;
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
            white-space: nowrap;
            transition: background .18s ease, border-color .18s ease, color .18s ease, transform .18s ease, box-shadow .18s ease;
        }

        .amount-button:hover,
        .amount-button:focus-visible {
            border-color: var(--green);
            color: var(--green-dark);
            background: #f2fff8;
            box-shadow: 0 10px 22px rgba(8, 115, 72, .14);
            outline: 0;
            transform: translateY(-2px);
        }

        .amount-button.is-selected {
            border-color: var(--green);
            color: var(--white);
            background: var(--green);
            box-shadow: 0 10px 24px rgba(8, 115, 72, .24);
        }

        @container (max-width: 410px) {
            .amount-button {
                font-size: 11px;
            }
        }

        @container (max-width: 350px) {
            .amount-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .custom-amount {
            display: flex;
            align-items: center;
            min-height: 40px;
            margin-bottom: 10px;
            padding: 0 10px;
            border: 1px solid #6e9d8d;
            background: rgba(255, 255, 255, .76);
            transition: border-color .18s ease, box-shadow .18s ease;
        }

        .custom-amount:focus-within {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(8, 115, 72, .14);
        }

        .currency-prefix {
            color: #2d5147;
            font-size: 13px;
            font-weight: 900;
        }

        .custom-amount input {
            width: 100%;
            min-width: 0;
            border: 0;
            color: #99aaa5;
            background: transparent;
            font: inherit;
            font-size: 13px;
            outline: 0;
        }

        .currency-select-wrap {
            display: grid;
            gap: 5px;
            margin-bottom: 10px;
            color: #416257;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .currency-select {
            width: 100%;
            min-height: 40px;
            border: 1px solid #6e9d8d;
            border-radius: 0;
            padding: 0 34px 0 10px;
            color: #2d5147;
            background: var(--white);
            font: inherit;
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
            outline: 0;
            transition: border-color .18s ease, box-shadow .18s ease;
        }

        .currency-select:hover,
        .currency-select:focus-visible {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(8, 115, 72, .14);
        }

        .payment-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
            margin-bottom: 12px;
        }

        .payment-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 58px;
            min-height: 28px;
            padding: 0 8px;
            border: 1px solid #d7dedb;
            background: var(--white);
            color: #24433a;
            font: inherit;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: 0;
            cursor: pointer;
            transition: background .18s ease, border-color .18s ease, color .18s ease, transform .18s ease, box-shadow .18s ease;
        }

        .payment-badge:hover,
        .payment-badge:focus-visible,
        .payment-badge.is-selected {
            border-color: var(--green);
            background: #f2fff8;
            color: var(--green-dark);
            box-shadow: 0 8px 18px rgba(8, 115, 72, .12);
            outline: 0;
            transform: translateY(-1px);
        }

        .payment-badge.paypal {
            color: #244e97;
            font-style: italic;
        }

        .payment-badge.gpay span:first-child {
            color: #4285f4;
        }

        .payment-badge.visa {
            color: #273a89;
        }

        .payment-badge.mastercard {
            color: var(--white);
            background: #2e2f36;
        }

        .payment-badge.amex {
            color: var(--white);
            background: #0878d7;
        }

        .payment-badge.discover {
            color: #3b3b3b;
        }

        .payment-badge.airtel {
            color: #d71920;
        }

        .payment-badge.mtn {
            color: #1f2937;
            background: #ffd429;
            border-color: #ffd429;
        }

        .donation-submit {
            width: 100%;
            min-height: 42px;
            border: 0;
            background: var(--green);
            color: var(--white);
            font: inherit;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            transition: background .18s ease, transform .18s ease, box-shadow .18s ease;
        }

        .donation-submit:hover,
        .donation-submit:focus-visible {
            background: var(--green-dark);
            box-shadow: 0 14px 28px rgba(6, 63, 46, .24);
            outline: 0;
            transform: translateY(-2px);
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1px;
            padding: clamp(38px, 5vw, 58px) clamp(18px, 5vw, 76px);
            background: #e6eee9;
        }

        .stat-card {
            padding: clamp(20px, 3vw, 32px);
            background: var(--white);
            text-align: center;
        }

        .stat-card strong {
            display: block;
            color: #007348;
            font-size: clamp(56px, 7vw, 88px);
            line-height: 1;
        }

        .stat-card > span {
            display: block;
            margin-top: 14px;
            color: var(--soft-ink);
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .trust-section {
            display: grid;
            grid-template-columns: minmax(42px, 80px) minmax(300px, .95fr) minmax(320px, 1.05fr);
            gap: clamp(22px, 4vw, 48px);
            align-items: center;
            padding: clamp(36px, 5vw, 56px) clamp(18px, 5vw, 76px);
            background: #fbfaf8;
        }

        .trust-vertical {
            justify-self: center;
            color: #f5a400;
            font-size: clamp(28px, 4vw, 46px);
            font-weight: 900;
            font-style: italic;
            line-height: 1.15;
            text-orientation: mixed;
            writing-mode: vertical-rl;
        }

        .trust-image {
            overflow: hidden;
            min-height: clamp(340px, 36vw, 500px);
            margin: 0;
            background: var(--line);
        }

        .trust-image img {
            width: 100%;
            height: 100%;
            min-height: clamp(340px, 36vw, 500px);
            object-fit: cover;
        }

        .trust-kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            color: #f5a400;
            font-size: 22px;
            font-weight: 900;
            font-style: italic;
        }

        .trust-kicker svg {
            width: 34px;
            height: 34px;
            stroke: currentColor;
            stroke-width: 1.8;
            fill: none;
        }

        .trust-copy h2 {
            max-width: 680px;
            margin: 0 0 clamp(24px, 3vw, 34px);
            color: #252525;
            font-size: clamp(34px, 4.5vw, 58px);
            line-height: 1.14;
        }

        .trust-list {
            display: grid;
            gap: 20px;
        }

        .trust-item {
            display: grid;
            grid-template-columns: 56px minmax(0, 1fr);
            gap: 16px;
            align-items: start;
        }

        .trust-icon {
            display: grid;
            width: 48px;
            height: 48px;
            place-items: center;
            color: #ff542c;
        }

        .trust-icon svg {
            width: 42px;
            height: 42px;
            stroke: currentColor;
            stroke-width: 1.7;
            fill: none;
        }

        .trust-item h3 {
            margin: 0 0 6px;
            color: #202020;
            font-size: clamp(22px, 2.1vw, 30px);
            line-height: 1.2;
        }

        .trust-item p {
            max-width: 680px;
            margin: 0;
            color: #59625f;
            font-size: clamp(16px, 1.6vw, 21px);
            line-height: 1.55;
        }

        .events-section,
        .news-section,
        .contact-section {
            padding: clamp(56px, 7vw, 86px) clamp(18px, 5vw, 76px);
        }

        .events-section {
            background: var(--white);
        }

        .news-section {
            background: #f7f4f3;
        }

        .contact-section {
            background: #eef6f1;
        }

        .section-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: clamp(28px, 4vw, 44px);
        }

        .section-head span {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            color: #f5a400;
            font-size: 15px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .section-head span::before {
            width: 34px;
            height: 2px;
            content: "";
            background: #f5a400;
        }

        .section-head h2 {
            max-width: 680px;
            margin: 0;
            color: #24211f;
            font-size: clamp(32px, 4vw, 50px);
            line-height: 1.08;
        }

        .section-head p {
            max-width: 440px;
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
        }

        .events-grid {
            display: grid;
            grid-template-columns: 1.08fr .92fr;
            gap: 24px;
        }

        .event-feature,
        .event-card,
        .news-card,
        .contact-form {
            border: 1px solid var(--line);
            background: var(--white);
            box-shadow: 0 18px 44px rgba(21, 33, 29, .08);
        }

        .event-feature {
            display: grid;
            grid-template-columns: minmax(220px, .78fr) minmax(0, 1fr);
            overflow: hidden;
        }

        .event-image,
        .news-image {
            min-height: 100%;
            background: var(--line);
        }

        .event-image img,
        .news-image img {
            width: 100%;
            height: 100%;
            min-height: 260px;
            object-fit: cover;
        }

        .event-content {
            padding: clamp(22px, 3vw, 34px);
        }

        .event-date {
            display: inline-grid;
            min-width: 76px;
            margin-bottom: 18px;
            padding: 10px 12px;
            background: #007348;
            color: var(--white);
            text-align: center;
        }

        .event-date strong {
            font-size: 30px;
            line-height: 1;
        }

        .event-date span {
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .event-content h3,
        .event-card h3,
        .news-card h3 {
            margin: 0 0 12px;
            color: #24211f;
            font-size: clamp(22px, 2.2vw, 30px);
            line-height: 1.18;
        }

        .event-content p,
        .event-card p,
        .news-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.62;
        }

        .event-details {
            display: grid;
            gap: 10px;
            margin: 20px 0;
            padding: 0;
            list-style: none;
        }

        .event-details li {
            display: flex;
            gap: 10px;
            color: var(--soft-ink);
            line-height: 1.45;
        }

        .event-details b {
            min-width: 78px;
            color: #007348;
        }

        .event-link,
        .news-link,
        .contact-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 20px;
            border: 0;
            background: #007348;
            color: var(--white);
            font: inherit;
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
        }

        .event-stack {
            display: grid;
            gap: 18px;
        }

        .event-card {
            padding: clamp(20px, 2.5vw, 28px);
        }

        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 14px;
        }

        .event-meta span {
            padding: 7px 10px;
            background: #eef6f1;
            color: #007348;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .news-card {
            overflow: hidden;
        }

        .news-card-body {
            padding: 24px;
        }

        .news-date {
            display: block;
            margin-bottom: 12px;
            color: #f5a400;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .news-link {
            min-height: 40px;
            margin-top: 20px;
            background: #ff542c;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            gap: clamp(24px, 5vw, 58px);
            align-items: start;
        }

        .contact-panel {
            padding: clamp(24px, 4vw, 42px);
            background: #073f31;
            color: var(--white);
        }

        .contact-panel h2 {
            margin: 0 0 16px;
            font-size: clamp(30px, 4vw, 48px);
            line-height: 1.08;
        }

        .contact-panel p {
            margin: 0 0 26px;
            color: rgba(255, 255, 255, .78);
            line-height: 1.65;
        }

        .contact-list-block {
            display: grid;
            gap: 14px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .contact-list-block li {
            display: grid;
            gap: 4px;
            padding: 14px 0;
            border-top: 1px solid rgba(255, 255, 255, .18);
        }

        .contact-list-block b {
            color: #ffe0a4;
            font-size: 13px;
            text-transform: uppercase;
        }

        .contact-form {
            display: grid;
            gap: 16px;
            padding: clamp(22px, 3vw, 34px);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .contact-form label {
            display: grid;
            gap: 8px;
            color: var(--soft-ink);
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .contact-form input,
        .contact-form select,
        .contact-form textarea {
            width: 100%;
            min-height: 50px;
            border: 1px solid var(--line);
            padding: 0 14px;
            color: var(--ink);
            background: #fbfcfa;
            font: inherit;
            outline: 0;
        }

        .contact-form textarea {
            min-height: 140px;
            padding-top: 14px;
            resize: vertical;
        }

        .contact-submit {
            justify-self: start;
            min-height: 52px;
            background: #ff542c;
        }

        .site-footer {
            color: rgba(255, 255, 255, .84);
            background: var(--green-dark);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.2fr repeat(3, 1fr);
            gap: clamp(24px, 4vw, 44px);
            padding: 58px clamp(18px, 5vw, 76px) 44px;
        }

        .footer-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            color: var(--white);
        }

        .footer-logo {
            width: auto;
            max-width: 190px;
            height: 56px;
            border-radius: 0;
            object-fit: contain;
        }

        .footer-col h3 {
            margin: 0 0 18px;
            color: var(--white);
            font-size: 17px;
        }

        .footer-col p {
            max-width: 360px;
            margin: 0;
            line-height: 1.65;
        }

        .footer-links,
        .footer-contact {
            display: grid;
            gap: 11px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .footer-links a,
        .footer-contact a {
            color: rgba(255, 255, 255, .78);
        }

        .footer-links a:hover,
        .footer-contact a:hover {
            color: #ffe0a4;
        }

        .footer-socials {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .footer-socials a {
            display: grid;
            width: 48px;
            height: 48px;
            place-items: center;
            border: 1px solid var(--white);
            background: var(--white);
            color: var(--green);
            transition: background .2s ease, color .2s ease, transform .2s ease;
        }

        .footer-socials a:hover {
            background: transparent;
            color: var(--white);
            transform: translateY(-2px);
        }

        .footer-socials svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
        }

        .footer-social-title {
            display: block;
            margin-top: 20px;
            color: var(--white);
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .volunteer-button {
            min-height: 34px;
            padding: 0 14px;
            border: 1px solid rgba(255, 255, 255, .72);
            background: transparent;
            color: var(--white);
            font-weight: 900;
        }

        .volunteer-button:hover {
            background: var(--white);
            color: var(--green-dark);
        }

        .hero-slider {
            min-height: 640px;
        }

        .slide {
            padding-top: clamp(30px, 4vw, 48px);
            padding-bottom: 54px;
        }

        .hero-inner {
            min-height: 500px;
            grid-template-columns: minmax(0, 1fr) minmax(360px, 400px);
            gap: clamp(24px, 4vw, 48px);
        }

        .donation-card {
            width: min(100%, 380px);
            padding: 16px;
            border-color: rgba(255, 255, 255, .98);
            background: var(--white);
            box-shadow: 0 24px 70px rgba(6, 63, 46, .42);
        }

        .stats-heading {
            grid-column: 1 / -1;
            margin-bottom: 14px;
            text-align: center;
        }

        .stats-heading span {
            display: block;
            margin-bottom: 8px;
            color: var(--green);
            font-size: 18px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .stats-heading h2 {
            margin: 0;
            color: var(--green-dark);
            font-size: 46px;
            line-height: 1.1;
        }

        .footer-note {
            margin-top: 18px;
            padding: 14px;
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 0;
            background: rgba(255, 255, 255, .07);
            font-size: 14px;
            line-height: 1.5;
        }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px clamp(18px, 5vw, 76px);
            border-top: 1px solid rgba(255, 255, 255, .14);
            color: rgba(255, 255, 255, .66);
            font-size: 14px;
        }

        .footer-bottom-links {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        @media (max-width: 920px) {
            .site-header {
                align-items: flex-start;
                display: flex;
                flex-direction: column;
            }

            .nav {
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .submenu {
                position: static;
                display: none;
                width: 100%;
                margin-top: 4px;
                opacity: 1;
                pointer-events: auto;
                transform: none;
            }

            .nav-item:hover .submenu,
            .nav-item:focus-within .submenu {
                display: grid;
            }

            .hero-slider {
                min-height: 1040px;
            }

            .hero-inner {
                grid-template-columns: 1fr;
                align-items: start;
                min-height: auto;
                gap: 34px;
            }

            .impact-section {
                grid-template-columns: 1fr;
            }

            .impact-copy {
                order: -1;
            }

            .causes-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .cause-card {
                min-width: calc((100% - 26px) / 2);
                grid-template-columns: 1fr;
            }

            .stats-section {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .trust-section {
                grid-template-columns: 1fr;
            }

            .trust-vertical {
                justify-self: start;
                writing-mode: horizontal-tb;
            }

            .section-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .events-grid,
            .event-feature,
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .news-grid {
                grid-template-columns: 1fr 1fr;
            }

            .donation-card {
                justify-self: stretch;
                width: 100%;
            }

            .slider-controls {
                left: 18px;
                right: 18px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 640px) {
            .top-bar,
            .top-group {
                align-items: flex-start;
                flex-direction: column;
            }

            .top-bar {
                gap: 10px;
            }

            .hero-slider {
                min-height: 1160px;
            }

            .slide {
                padding-top: 54px;
            }

            .amount-grid {
                grid-template-columns: 1fr 1fr;
            }

            .amount-button {
                min-height: 38px;
                font-size: 11px;
            }

            .donation-card {
                padding: 12px;
            }

            .button {
                width: 100%;
            }

            .impact-images {
                min-height: auto;
                grid-template-columns: 1fr;
            }

            .impact-image {
                height: 220px;
            }

            .impact-copy h2 {
                font-size: clamp(24px, 7vw, 34px);
            }

            .program-cards {
                grid-template-columns: 1fr;
            }

            .program-card {
                min-height: 128px;
                aspect-ratio: auto;
            }

            .cause-card {
                min-width: 100%;
                min-height: auto;
            }

            .cause-image,
            .cause-image img {
                min-height: 180px;
            }

            .stats-section {
                grid-template-columns: 1fr;
            }

            .trust-image,
            .trust-image img {
                min-height: 320px;
            }

            .trust-copy h2 {
                font-size: clamp(30px, 9vw, 42px);
            }

            .trust-item {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .news-grid,
            .form-row {
                grid-template-columns: 1fr;
            }

        }

        /* Final visual system: green and white palette, Quicksand type scale. */
        :root {
            --ink: #073f31;
            --soft-ink: #0f5a42;
            --muted: #2f6e58;
            --line: #d9ebe2;
            --green: #087348;
            --green-dark: #063f2e;
            --teal: #087348;
            --gold: #087348;
            --coral: #087348;
            --paper: #ffffff;
            --white: #ffffff;
        }

        body {
            color: var(--green-dark);
            font-family: 'Quicksand', Arial, Helvetica, sans-serif;
            font-size: 18px;
            background: var(--white);
        }

        h1,
        .impact-copy h2,
        .causes-heading h2,
        .section-head h2,
        .trust-copy h2,
        .contact-panel h2 {
            color: inherit;
            font-size: 46px;
            line-height: 1.14;
            font-weight: 800;
            letter-spacing: 0;
        }

        .program-card h3,
        .cause-card h3,
        .trust-item h3,
        .event-content h3,
        .event-card h3,
        .news-card h3,
        .footer-col h3 {
            font-size: 24px;
            line-height: 1.24;
            font-weight: 800;
        }

        .lead,
        .impact-copy,
        .causes-heading p,
        .event-content p,
        .event-card p,
        .news-card p,
        .trust-item p,
        .section-head p,
        .contact-panel p,
        .footer-col p,
        .event-details li,
        .contact-list-block,
        .footer-contact,
        .footer-links {
            font-size: 18px;
            line-height: 1.65;
        }

        .top-bar,
        .site-footer,
        .hero-slider,
        .cause-card,
        .contact-panel {
            background: var(--green-dark);
        }

        .site-header,
        .impact-section,
        .causes-section,
        .stats-section,
        .trust-section,
        .events-section,
        .news-section,
        .contact-section,
        .stat-card,
        .program-card,
        .event-feature,
        .event-card,
        .news-card,
        .contact-form {
            background: var(--white);
        }

        .stats-section,
        .news-section,
        .contact-section {
            background: #f4fbf7;
        }

        .eyebrow,
        .trust-kicker,
        .section-head span,
        .trust-vertical,
        .cause-kicker,
        .news-date {
            color: var(--green);
        }

        .eyebrow::before,
        .section-head span::before,
        .slider-dot.is-active,
        .cause-dot.is-active {
            background: var(--green);
        }

        .impact-copy .green-mark,
        .impact-copy .green-text,
        .nav a:hover,
        .nav-trigger:hover,
        .event-details b,
        .event-meta span,
        .stat-card strong,
        .program-card h3,
        .news-card h3,
        .event-content h3,
        .event-card h3,
        .trust-item h3 {
            color: var(--green);
        }

        .stat-card strong {
            font-size: clamp(56px, 7vw, 88px);
        }

        .stat-card .stat-number {
            font-size: inherit;
        }

        .stat-card > span {
            font-size: 14px;
        }

        .impact-copy .green-mark,
        .nav .donate-link,
        .nav .donate-link .nav-trigger,
        .button.primary,
        .program-link,
        .cause-link,
        .cause-link.gold,
        .cause-arrow,
        .event-date,
        .event-link,
        .news-link,
        .contact-submit,
        .submenu a:hover {
            background: var(--green);
            color: var(--white);
            box-shadow: none;
        }

        .button.secondary {
            border-color: rgba(255, 255, 255, .7);
            background: rgba(255, 255, 255, .14);
            color: var(--white);
        }

        .slide::before {
            background: linear-gradient(90deg, rgba(6, 63, 46, .9), rgba(6, 63, 46, .68), rgba(6, 63, 46, .3));
        }

        .slide::after {
            background: linear-gradient(0deg, rgba(6, 63, 46, .72), transparent);
        }

        .impact-copy .green-mark {
            display: inline;
            padding: 0;
        }

        .cause-card::before {
            border-color: rgba(255, 255, 255, .12);
        }

        .event-meta span,
        .contact-form input,
        .contact-form select,
        .contact-form textarea,
        .custom-amount,
        .currency-select,
        .amount-button,
        .payment-badge {
            background: var(--white);
            border-color: var(--line);
            color: var(--green-dark);
        }

        .payment-badge.paypal,
        .payment-badge.visa,
        .payment-badge.airtel {
            color: var(--green-dark);
        }

        .payment-badge.mtn {
            background: #ffd429;
            border-color: #ffd429;
            color: #1f2937;
        }

        .donation-card,
        .donation-note,
        .donation-note::before,
        .donation-toggle {
            background: var(--white);
            color: var(--green-dark);
        }

        .donation-card {
            border-color: rgba(255, 255, 255, .9);
        }

        .donation-note,
        .donation-toggle {
            border: 1px solid var(--line);
        }

        .toggle-option.active,
        .step-dot.active {
            background: var(--green);
            color: var(--white);
        }

        .toggle-heart,
        .trust-icon,
        .currency-prefix,
        .currency-select-wrap,
        .donation-title,
        .amount-button {
            color: var(--green);
        }

        .amount-button.is-selected,
        .toggle-option.active,
        .toggle-option[aria-pressed="true"],
        .donation-submit {
            background: var(--green);
            color: var(--white);
        }

        .contact-list-block b,
        .footer-links a:hover,
        .footer-contact a:hover {
            color: var(--white);
        }

        @media (max-width: 640px) {
            h1,
            .impact-copy h2,
            .causes-heading h2,
            .section-head h2,
            .trust-copy h2,
            .contact-panel h2 {
                font-size: 46px;
            }
        }

        .causes-section {
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #f4fbf7 0%, var(--white) 100%);
        }

        .causes-section::before {
            position: absolute;
            top: 42px;
            right: clamp(18px, 5vw, 76px);
            width: min(32vw, 360px);
            height: min(32vw, 360px);
            content: "";
            border: 34px solid rgba(8, 115, 72, .08);
            border-radius: 999px;
            pointer-events: none;
        }

        .causes-heading {
            position: relative;
            z-index: 1;
            align-items: center;
        }

        .causes-heading h2 {
            max-width: 560px;
        }

        .causes-heading p {
            max-width: 520px;
            padding: 18px 22px;
            border-left: 4px solid var(--green);
            background: var(--white);
            box-shadow: 0 12px 32px rgba(8, 115, 72, .08);
        }

        .causes-carousel {
            padding: 10px 58px 0;
        }

        .causes-track {
            gap: 22px;
        }

        .cause-card {
            min-width: calc((100% - 44px) / 3);
            grid-template-columns: 1fr;
            gap: 0;
            align-items: stretch;
            min-height: 420px;
            padding: 0;
            border: 1px solid var(--line);
            background: var(--white);
            color: var(--green-dark);
            box-shadow: 0 18px 46px rgba(8, 115, 72, .1);
        }

        .cause-card::before {
            content: none;
        }

        .cause-image {
            order: -1;
            min-height: 190px;
        }

        .cause-image img {
            min-height: 190px;
            transition: transform .45s ease;
        }

        .cause-card:hover .cause-image img {
            transform: scale(1.04);
        }

        .cause-content {
            display: grid;
            align-content: space-between;
            min-height: 210px;
            padding: 24px;
        }

        .cause-kicker {
            display: inline-flex;
            justify-self: start;
            margin-bottom: 14px;
            padding: 7px 12px;
            border-radius: 999px;
            background: #f4fbf7;
            color: var(--green);
            font-size: 15px;
            font-style: normal;
        }

        .cause-card h3 {
            color: var(--green-dark);
            font-size: 24px;
        }

        .cause-link,
        .cause-link.gold {
            min-height: 44px;
            margin-top: 22px;
            border: 1px solid var(--green);
            border-radius: 0;
            background: var(--green);
            color: var(--white);
            font-size: 15px;
        }

        .cause-arrow {
            width: 46px;
            height: 46px;
            border: 1px solid var(--line);
            background: var(--white);
            color: var(--green);
            box-shadow: 0 14px 34px rgba(8, 115, 72, .16);
        }

        .cause-arrow.prev {
            left: 0;
        }

        .cause-arrow.next {
            right: 0;
        }

        .cause-controls {
            margin-top: 30px;
        }

        .cause-dot {
            width: 12px;
            height: 12px;
            border-radius: 999px;
            background: #cfe4d9;
        }

        .cause-dot.is-active {
            width: 36px;
            border-radius: 999px;
            background: var(--green);
        }

        @media (max-width: 920px) {
            .causes-carousel {
                padding-inline: 54px;
            }

            .cause-card {
                min-width: calc((100% - 22px) / 2);
            }
        }

        @media (max-width: 640px) {
            .causes-carousel {
                padding-inline: 0;
            }

            .cause-card {
                min-width: 100%;
            }

            .cause-arrow {
                top: auto;
                bottom: 32px;
                transform: none;
            }
        }

        .events-section {
            background: var(--white);
        }

        .events-section .section-head {
            display: block;
            text-align: center;
        }

        .events-section .section-head p {
            display: none;
        }

        .events-section .section-head span {
            justify-content: center;
        }

        .events-section .section-head span::before {
            content: none;
        }

        .events-section .section-head h2 {
            max-width: none;
            margin: 0 auto;
        }

        .events-grid {
            grid-template-columns: minmax(360px, .95fr) minmax(360px, 1.05fr);
            gap: 24px;
            align-items: stretch;
        }

        .event-feature {
            position: relative;
            display: block;
            min-height: 610px;
            border: 0;
            box-shadow: none;
        }

        .event-feature .event-image {
            position: absolute;
            inset: 0;
        }

        .event-feature .event-image img {
            min-height: 610px;
        }

        .event-feature::after {
            position: absolute;
            inset: 0;
            content: "";
            background: linear-gradient(180deg, rgba(6, 63, 46, .05), rgba(6, 63, 46, .86));
        }

        .event-feature .event-content {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            color: var(--white);
        }

        .event-feature .event-content h3,
        .event-feature .event-content p,
        .event-feature .event-details li,
        .event-feature .event-details b {
            color: var(--white);
        }

        .event-feature .event-date {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            margin-bottom: 22px;
            padding: 0;
            background: transparent;
            color: var(--white);
            text-align: left;
        }

        .event-feature .event-date strong,
        .event-feature .event-date span {
            font-size: 18px;
            line-height: 1;
        }

        .event-tag {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            padding: 12px 18px;
            background: var(--green);
            color: var(--white);
            font-size: 16px;
            font-weight: 800;
        }

        .event-stack {
            gap: 20px;
        }

        .event-card {
            display: grid;
            grid-template-columns: minmax(190px, .9fr) minmax(0, 1fr);
            gap: 24px;
            align-items: center;
            padding: 14px;
            border: 0;
            background: var(--green);
            color: var(--white);
            box-shadow: none;
        }

        .event-card .event-image {
            position: relative;
            min-height: 178px;
        }

        .event-card .event-image img {
            min-height: 178px;
        }

        .event-card .event-tag {
            font-size: 14px;
            padding: 9px 14px;
            background: var(--white);
            color: var(--green);
        }

        .event-card .event-content {
            padding: 0 10px 0 0;
        }

        .event-meta {
            color: var(--white);
            font-size: 18px;
            font-weight: 800;
        }

        .event-meta span {
            padding: 0;
            background: transparent;
            color: inherit;
            font-size: inherit;
            text-transform: none;
        }

        .event-details-link {
            display: inline-flex;
            margin-top: 14px;
            color: var(--white);
            font-size: 18px;
            font-weight: 800;
            text-decoration: underline;
        }

        .event-card h3,
        .event-card p {
            color: var(--white);
        }

        @media (max-width: 920px) {
            .events-grid,
            .event-card {
                grid-template-columns: 1fr;
            }

            .event-feature {
                min-height: 520px;
            }

            .event-feature .event-image img {
                min-height: 520px;
            }
        }

        .news-section {
            position: relative;
            overflow: hidden;
            background: #f4fbf7;
        }

        .news-section::before {
            position: absolute;
            right: -120px;
            bottom: -160px;
            width: 360px;
            height: 360px;
            content: "";
            border: 40px solid rgba(8, 115, 72, .08);
            border-radius: 999px;
        }

        .news-section .section-head {
            position: relative;
            z-index: 1;
            align-items: center;
        }

        .news-section .section-head p {
            padding: 18px 22px;
            border-left: 4px solid var(--green);
            background: var(--white);
            box-shadow: 0 12px 32px rgba(8, 115, 72, .08);
        }

        .news-grid {
            position: relative;
            z-index: 1;
            gap: 26px;
        }

        .news-card {
            position: relative;
            border: 0;
            background: var(--white);
            box-shadow: 0 20px 50px rgba(8, 115, 72, .1);
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .news-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 28px 70px rgba(8, 115, 72, .16);
        }

        .news-image {
            position: relative;
            min-height: 260px;
            overflow: hidden;
        }

        .news-image img {
            min-height: 260px;
            transition: transform .45s ease;
        }

        .news-card:hover .news-image img {
            transform: scale(1.04);
        }

        .news-category {
            position: absolute;
            left: 18px;
            bottom: 18px;
            z-index: 1;
            padding: 8px 13px;
            background: var(--white);
            color: var(--green);
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .news-card-body {
            display: grid;
            min-height: 280px;
            align-content: space-between;
            padding: 26px;
        }

        .news-date {
            color: var(--green);
            font-size: 14px;
        }

        .news-card h3 {
            color: var(--green-dark);
        }

        .news-card p {
            color: var(--muted);
        }

        .news-link {
            justify-self: start;
            min-height: 44px;
            border: 1px solid var(--green);
            background: var(--green);
            color: var(--white);
            font-size: 15px;
        }

        @media (max-width: 640px) {
            .news-card-body {
                min-height: auto;
            }
        }

        @media (max-width: 920px) {
            .hero-slider {
                min-height: 900px;
            }

            .hero-inner {
                min-height: auto;
            }
        }

        @media (max-width: 640px) {
            .hero-slider {
                min-height: 960px;
            }

            .slide {
                padding-top: 36px;
                padding-bottom: 46px;
            }
        }

        /* Final requested homepage adjustments. Keep this block last. */
        .contact-list .volunteer-button {
            min-height: 36px !important;
            padding: 0 16px !important;
            border: 1px solid rgba(255, 255, 255, .9) !important;
            background: transparent !important;
            color: var(--white) !important;
        }

        .contact-list .volunteer-button:hover {
            background: var(--white) !important;
            color: var(--green-dark) !important;
        }

        .hero-slider {
            min-height: 560px !important;
        }

        .slide {
            padding-top: 26px !important;
            padding-bottom: 38px !important;
        }

        .slide::before {
            background:
                linear-gradient(90deg, rgba(6, 63, 46, .62) 0%, rgba(6, 63, 46, .36) 42%, rgba(6, 63, 46, .12) 100%),
                var(--hero-image) !important;
            background-position: center !important;
            background-size: cover !important;
        }

        .slide::after {
            height: 22% !important;
            background: linear-gradient(0deg, rgba(6, 63, 46, .42), transparent) !important;
        }

        .hero-inner {
            min-height: 440px !important;
            grid-template-columns: minmax(0, 1fr) minmax(390px, 430px) !important;
            align-items: end !important;
        }

        .slide-content {
            align-self: center !important;
        }

        .donation-card {
            align-self: end !important;
            width: min(100%, 430px) !important;
            margin-bottom: 0 !important;
            padding: 20px !important;
            border: 2px solid var(--white) !important;
            background: var(--white) !important;
            box-shadow: 0 28px 90px rgba(6, 63, 46, .48) !important;
        }

        .donation-title {
            font-size: 18px !important;
            font-weight: 800 !important;
        }

        .amount-button {
            min-height: 46px !important;
            font-size: 13px !important;
        }

        @media (max-width: 920px) {
            .hero-slider {
                min-height: 820px !important;
            }

            .hero-inner {
                grid-template-columns: 1fr !important;
                min-height: 700px !important;
                align-content: end !important;
                align-items: end !important;
            }

            .donation-card {
                width: min(100%, 430px) !important;
                justify-self: start !important;
            }
        }

        @media (max-width: 640px) {
            .hero-slider {
                min-height: 880px !important;
            }

            .donation-card {
                width: 100% !important;
            }
        }

        /* Professional fundraising cards for causes. */
        .cause-card {
            min-height: 520px !important;
        }

        .cause-content {
            min-height: 300px !important;
            padding: 18px !important;
            grid-template-rows: 1fr auto;
        }

        .cause-body {
            display: grid;
            gap: 10px;
        }

        .cause-card h3 {
            font-size: 22px !important;
            line-height: 1.18 !important;
        }

        .cause-image .cause-kicker {
            position: absolute;
            top: 16px;
            left: 16px;
            z-index: 2;
            margin: 0;
            border: 1px solid rgba(255, 255, 255, .82);
            border-radius: 0;
            background: rgba(6, 63, 46, .22);
            color: var(--white);
            backdrop-filter: blur(8px);
        }

        .funding-summary {
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .funding-box {
            padding: 8px 10px;
            border: 1px solid var(--line);
            background: #f4fbf7;
        }

        .funding-box span {
            display: block;
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .funding-box strong {
            color: var(--green-dark);
            font-size: 17px;
            line-height: 1;
            overflow-wrap: anywhere;
        }

        .progress-wrap {
            display: grid;
            gap: 8px;
        }

        .progress-meta {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            color: var(--green);
            font-size: 13px;
            font-weight: 900;
        }

        .progress-bar {
            height: 10px;
            overflow: hidden;
            background: #d9ebe2;
        }

        .progress-bar span {
            display: block;
            width: var(--progress);
            height: 100%;
            background: var(--green);
        }

        .cause-link,
        .cause-link.gold {
            width: 100%;
            margin-top: 0 !important;
            min-height: 42px !important;
            font-size: 14px !important;
            padding: 0 12px !important;
            text-align: center;
        }

        @media (min-width: 1180px) {
            .funding-summary {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="top-bar" aria-label="Organisation contact information">
        <div class="contact-list">
            <a class="top-link" href="tel:{{ $settings['phone_href'] }}">
                <svg class="top-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.77.62 2.61a2 2 0 0 1-.45 2.11L8 9.72a16 16 0 0 0 6.28 6.28l1.28-1.28a2 2 0 0 1 2.11-.45c.84.29 1.71.5 2.61.62A2 2 0 0 1 22 16.92z"/></svg>
                <span>{{ $settings['phone_label'] }}</span>
            </a>
            <a class="top-link" href="mailto:{{ $settings['email'] }}">
                <svg class="top-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h16v16H4z"/><path d="m22 6-10 7L2 6"/></svg>
                <span>{{ $settings['email'] }}</span>
            </a>
            <a class="top-link" href="{{ $settings['location_url'] }}">
                <svg class="top-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0z"/><path d="M12 10h.01"/></svg>
                <span>{{ $settings['location_label'] }}</span>
            </a>
            <a class="top-link volunteer-button" href="{{ $settings['volunteer_url'] }}">
                <svg class="top-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><path d="M19 8v6"/><path d="M22 11h-6"/></svg>
                <span>{{ $settings['volunteer_label'] }}</span>
            </a>
        </div>
        <div class="top-group">
            <span>Registration No: {{ $settings['registration_number'] }}</span>
        </div>
    </div>

    <header class="site-header">
        <a class="brand" href="/">
            @if ($settings['logo_image'])
                <img class="brand-mark" src="{{ $settings['logo_image'] }}" alt="{{ $settings['logo_name'] }} logo">
            @endif
        </a>
        <nav class="nav" aria-label="Main navigation">
            @foreach ($settings['menus'] as $menu)
                <div class="nav-item {{ $menu['highlight'] ? 'donate-link' : '' }}">
                    <a class="nav-trigger" href="{{ $menu['url'] }}">{{ $menu['label'] }}</a>
                    @if (! empty($menu['children']))
                        <div class="submenu">
                            @foreach ($menu['children'] as $child)
                                <a href="{{ $child['url'] }}">{{ $child['label'] }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </nav>
    </header>

    <main>
        <section id="donate" class="hero-slider" aria-label="Featured charity work">
            @foreach ($slides as $slide)
                <article class="slide {{ $loop->first ? 'is-active' : '' }}" style="--hero-image: url('{{ $slide['image'] }}');">
                    <div class="hero-inner">
                        <div class="slide-content">
                            <p class="eyebrow">{{ $slide['eyebrow'] }}</p>
                            <h1>{{ $slide['title'] }}</h1>
                            <p class="lead">{{ $slide['lead'] }}</p>
                            <div class="actions">
                                <a class="button primary" href="{{ $slide['primary_url'] }}">{{ $slide['primary_label'] }}</a>
                                <a class="button secondary" href="{{ $slide['secondary_url'] }}">{{ $slide['secondary_label'] }}</a>
                            </div>
                        </div>

                        <form class="donation-card" action="/donate" method="GET" aria-label="Donation form" data-donation-form>
                            <div class="donation-steps" aria-hidden="true">
                                <span class="step-dot active"></span>
                                <span class="step-line"></span>
                                <span class="step-dot"></span>
                                <span class="step-line"></span>
                                <span class="step-dot"></span>
                            </div>

                            <div class="donation-toggle" aria-label="Donation frequency">
                                <button class="toggle-option active" type="button" data-frequency="one-time" aria-pressed="true">One-time</button>
                                <button class="toggle-option" type="button" data-frequency="monthly" aria-pressed="false"><span class="toggle-heart">&hearts;</span> Monthly</button>
                            </div>
                            <input type="hidden" name="frequency" value="one-time" data-frequency-input>

                            <div class="donation-note">Giving monthly has a greater impact</div>
                            <h2 class="donation-title">Give to {{ $settings['logo_name'] }}</h2>

                            <div class="amount-grid">
                                <button class="amount-button" type="button" data-ugx="63330" data-usd="17">Sh63,330</button>
                                <button class="amount-button" type="button" data-ugx="105550" data-usd="28">Sh105,550</button>
                                <button class="amount-button" type="button" data-ugx="189990" data-usd="50">Sh189,990</button>
                                <button class="amount-button" type="button" data-ugx="253320" data-usd="67">Sh253,320</button>
                                <button class="amount-button" type="button" data-ugx="633300" data-usd="167">Sh633,300</button>
                                <button class="amount-button" type="button" data-ugx="2111000" data-usd="556">Sh2,111,000</button>
                            </div>

                            <label class="custom-amount">
                                <span class="currency-prefix" data-currency-prefix>Sh&nbsp;</span>
                                <input name="amount" inputmode="numeric" placeholder="975" aria-label="Custom donation amount">
                            </label>

                            <label class="currency-select-wrap">
                                Donating in
                                <select class="currency-select" name="currency" data-currency-select>
                                    <option value="UGX" selected>Ugandan Shillings (UGX)</option>
                                    <option value="USD">US Dollars (USD)</option>
                                </select>
                            </label>

                            <div class="payment-row" aria-label="Accepted payment methods">
                                <button class="payment-badge visa is-selected" type="button" data-payment="visa" aria-pressed="true">VISA</button>
                                <button class="payment-badge paypal" type="button" data-payment="paypal" aria-pressed="false">PayPal</button>
                                <button class="payment-badge airtel" type="button" data-payment="airtel-money" aria-pressed="false">Airtel Money</button>
                                <button class="payment-badge mtn" type="button" data-payment="mtn-mobile-money" aria-pressed="false">MTN Mobile Money</button>
                            </div>
                            <input type="hidden" name="payment_method" value="visa" data-payment-input>

                            <button class="donation-submit" type="submit">Donate Now</button>
                        </form>
                    </div>
                </article>
            @endforeach

            <div class="slider-controls" aria-label="Hero slider controls">
                @foreach ($slides as $slide)
                    <button class="slider-dot {{ $loop->first ? 'is-active' : '' }}" type="button" aria-label="Show slide {{ $loop->iteration }}"></button>
                @endforeach
            </div>
        </section>

        <section id="projects" class="impact-section" aria-label="Nicoville sustainable projects">
            <div class="impact-images">
                @php $impactSlides = array_values($slides); @endphp
                @foreach (array_slice($impactSlides, 0, 3) as $columnIndex => $slide)
                    <figure class="impact-image impact-rotating-gallery">
                        @foreach ($impactSlides as $imageIndex => $imageSlide)
                            @php $isActiveImpactImage = $imageIndex === ($columnIndex % count($impactSlides)); @endphp
                            <img class="impact-rotating-image {{ $isActiveImpactImage ? 'is-active' : '' }}" src="{{ $imageSlide['image'] }}" alt="Nicoville community project image {{ $columnIndex + 1 }} variation {{ $imageIndex + 1 }}">
                        @endforeach
                        <div class="impact-image-dots" aria-hidden="true">
                            @foreach ($impactSlides as $imageIndex => $imageSlide)
                                <span class="{{ $imageIndex === ($columnIndex % count($impactSlides)) ? 'is-active' : '' }}"></span>
                            @endforeach
                        </div>
                    </figure>
                @endforeach
            </div>

            <div class="impact-copy">
                <h2>
                    {{ $pageContent['home']['impact_statement'] }}
                </h2>
            </div>
        </section>

        <section id="causes" class="causes-section" aria-label="Contribute to our causes">
            <div class="causes-heading">
                <h2>{{ $pageContent['home']['causes_heading'] }}</h2>
                <p>{{ $pageContent['home']['causes_intro'] }}</p>
            </div>

            <div class="causes-carousel">
                <button class="cause-arrow prev" type="button" aria-label="Previous cause">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </button>

                <div class="causes-track">
                    @foreach ($causes as $cause)
                        @php
                            $progress = $cause['target'] > 0 ? min(100, (int) round(($cause['raised'] / $cause['target']) * 100)) : 0;
                        @endphp
                        <article class="cause-card">
                            <div class="cause-content">
                                <div class="cause-body">
                                    <h3>{{ $cause['title'] }}</h3>
                                    <div class="funding-summary">
                                        <div class="funding-box">
                                            <span>Target</span>
                                            <strong>Sh{{ number_format($cause['target']) }}</strong>
                                        </div>
                                        <div class="funding-box">
                                            <span>Raised</span>
                                            <strong>Sh{{ number_format($cause['raised']) }}</strong>
                                        </div>
                                    </div>
                                    <div class="progress-wrap">
                                        <div class="progress-meta">
                                            <span>Raised so far</span>
                                            <span>{{ $progress }}%</span>
                                        </div>
                                        <div class="progress-bar" style="--progress: {{ $progress }}%;"><span></span></div>
                                    </div>
                                </div>
                                <a class="cause-link {{ $loop->odd ? 'gold' : '' }}" href="/donate?cause={{ urlencode($cause['title']) }}">Contribute to Cause</a>
                            </div>
                            <div class="cause-image">
                                <span class="cause-kicker">{{ $cause['category'] }}</span>
                                <img src="{{ $cause['image'] }}" alt="{{ $cause['title'] }}">
                            </div>
                        </article>
                    @endforeach
                </div>

                <button class="cause-arrow next" type="button" aria-label="Next cause">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>

                <div class="cause-controls" aria-label="Cause slider controls">
                    @foreach ($causes as $cause)
                        <button class="cause-dot {{ $loop->first ? 'is-active' : '' }}" type="button" aria-label="Show cause {{ $loop->iteration }}"></button>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="stats-section" aria-label="Nicoville impact statistics">
            <div class="stats-heading">
                <span>{{ $pageContent['home']['stats_title'] }}</span>
                <h2>{{ $pageContent['home']['stats_title'] }}</h2>
            </div>
            @foreach ($pageContent['home']['stats'] as $stat)
                <article class="stat-card">
                    <strong><span class="stat-number" data-count="{{ $stat['number'] }}">0</span>{{ $stat['suffix'] }}</strong>
                    <span>{{ $stat['label'] }}</span>
                </article>
            @endforeach
        </section>

        <section class="trust-section" aria-label="Why donate to Nicoville">
            <div class="trust-vertical">Best charity foundation</div>

            <figure class="trust-image">
                <img src="{{ $slides[2]['image'] ?? $slides[0]['image'] }}" alt="Nicoville volunteers supporting the community">
            </figure>

            <div class="trust-copy">
                <div class="trust-kicker">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M8 12c-2-2.5-3-4.8-2-6.4 1.2-1.9 4.1-.8 6 2.2 1.9-3 4.8-4.1 6-2.2 1 1.6 0 3.9-2 6.4"></path>
                        <path d="M7 12v4a5 5 0 0 0 10 0v-4"></path>
                        <path d="M12 8v10"></path>
                    </svg>
                    <span>{{ $pageContent['home']['trust_kicker'] }}</span>
                </div>

                <h2>{{ $pageContent['home']['trust_title'] }}</h2>

                <div class="trust-list">
                    @foreach ($pageContent['home']['trust_items'] as $item)
                        <article class="trust-item">
                            <div class="trust-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <path d="M5 10h14v10H5z"></path>
                                    <path d="M12 10v10"></path>
                                    <path d="M5 14h14"></path>
                                </svg>
                            </div>
                            <div>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="events" class="events-section" aria-label="Upcoming events">
            <div class="section-head">
                <div>
                    <span>{{ $pageContent['home']['events_kicker'] }}</span>
                    <h2>{{ $pageContent['home']['events_title'] }}</h2>
                </div>
                <p>{{ $pageContent['home']['events_intro'] }}</p>
            </div>

            <div class="events-grid">
                @php $featuredEvent = $events[0] ?? null; @endphp
                @if ($featuredEvent)
                <article class="event-feature">
                    <span class="event-tag">{{ $featuredEvent['category'] }}</span>
                    <div class="event-image">
                        <img src="{{ $featuredEvent['image'] }}" alt="{{ $featuredEvent['title'] }}">
                    </div>
                    <div class="event-content">
                        <div class="event-date">
                            <strong>{{ $featuredEvent['date'] }}</strong>
                            <span>{{ $featuredEvent['time'] }}</span>
                        </div>
                        <h3>{{ $featuredEvent['title'] }}</h3>
                        <p>{{ $featuredEvent['summary'] }}</p>
                        <ul class="event-details">
                            <li><b>Venue</b> {{ $featuredEvent['venue'] }}</li>
                            <li><b>Program</b> {{ $featuredEvent['category'] }}</li>
                        </ul>
                    </div>
                </article>
                @endif

                <div class="event-stack">
                    @foreach (array_slice($events, 1, 3) as $event)
                        <article class="event-card">
                            <div class="event-image">
                                <span class="event-tag">{{ $event['category'] }}</span>
                                <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}">
                            </div>
                            <div class="event-content">
                                <div class="event-meta">
                                    <span>{{ $event['date'] }}</span>
                                    <span>{{ $event['time'] }}</span>
                                </div>
                                <h3>{{ $event['title'] }}</h3>
                                <a class="event-details-link" href="/events/{{ $event['slug'] }}">Event Details</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="news" class="news-section" aria-label="Blogs and news">
            <div class="section-head">
                <div>
                    <span>{{ $pageContent['home']['news_kicker'] }}</span>
                    <h2>{{ $pageContent['home']['news_title'] }}</h2>
                </div>
                <p>{{ $pageContent['home']['news_intro'] }}</p>
            </div>

            <div class="news-grid">
                @foreach (array_slice($posts, 0, 3) as $post)
                    <article class="news-card">
                        <div class="news-image">
                            <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}">
                            <span class="news-category">{{ $post['category'] }}</span>
                        </div>
                        <div class="news-card-body">
                            <span class="news-date">{{ $post['date'] }}</span>
                            <h3>{{ $post['title'] }}</h3>
                            <p>{{ $post['summary'] }}</p>
                            <a class="news-link" href="{{ $post['link_url'] ?? '/news' }}">{{ $post['link_label'] ?? 'Read More' }}</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="contact" class="contact-section" aria-label="Contact us">
            <div class="contact-grid">
                <div class="contact-panel">
                    <h2>{{ $pageContent['home']['contact_title'] }}</h2>
                    <p>{{ $pageContent['home']['contact_intro'] }}</p>
                    <ul class="contact-list-block">
                        <li>
                            <b>Phone</b>
                            <a href="tel:{{ $settings['phone_href'] }}">{{ $settings['phone_label'] }}</a>
                        </li>
                        <li>
                            <b>Email</b>
                            <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
                        </li>
                        <li>
                            <b>Location</b>
                            <span>{{ $settings['location_label'] }}</span>
                        </li>
                    </ul>
                </div>

                <form class="contact-form" action="mailto:{{ $settings['email'] }}" method="POST" enctype="text/plain">
                    <div class="form-row">
                        <label>
                            Full Name
                            <input name="name" type="text" placeholder="Your name" required>
                        </label>
                        <label>
                            Email Address
                            <input name="email" type="email" placeholder="you@example.com" required>
                        </label>
                    </div>

                    <div class="form-row">
                        <label>
                            Phone Number
                            <input name="phone" type="tel" placeholder="+256...">
                        </label>
                        <label>
                            Interest
                            <select name="interest" required>
                                <option value="">Choose one</option>
                                <option>Volunteer</option>
                                <option>Donate</option>
                                <option>Partner With Us</option>
                                <option>Upcoming Events</option>
                            </select>
                        </label>
                    </div>

                    <label>
                        Message
                        <textarea name="message" placeholder="Tell us how you would like to connect with Nicoville..." required></textarea>
                    </label>

                    <button class="contact-submit" type="submit">{{ $pageContent['home']['contact_button'] }}</button>
                </form>
            </div>
        </section>

    </main>

    <footer class="site-footer">
        <div class="footer-grid">
            <div class="footer-col">
                <a class="footer-brand" href="/">
                    @if ($settings['logo_image'])
                        <img class="footer-logo" src="{{ $settings['logo_image'] }}" alt="{{ $settings['logo_name'] }} logo">
                    @endif
                </a>
                <p>{{ $pageContent['home']['footer_text'] }}</p>
            </div>

            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    @foreach ($settings['menus'] as $menu)
                        <li><a href="{{ $menu['url'] }}">{{ $menu['label'] }}</a></li>
                        @foreach ($menu['children'] ?? [] as $child)
                            <li><a href="{{ $child['url'] }}">{{ $child['label'] }}</a></li>
                        @endforeach
                    @endforeach
                </ul>
            </div>

            <div class="footer-col">
                <h3>Support</h3>
                <ul class="footer-links">
                    @foreach ($pageContent['home']['footer_support_links'] as $link)
                        <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-col">
                <h3>Contact</h3>
                <ul class="footer-contact">
                    <li><a href="tel:{{ $settings['phone_href'] }}">{{ $settings['phone_label'] }}</a></li>
                    <li><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></li>
                    <li>Kampala, Uganda</li>
                    <li>Mon - Fri: 8:00 AM - 5:00 PM</li>
                </ul>
                <span class="footer-social-title">Follow Us</span>
                <div class="footer-socials" aria-label="Social media links">
                    <a href="https://www.facebook.com/" target="_blank" rel="noopener" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8h3V4h-3c-3.3 0-5 2-5 5v2H6v4h3v5h4v-5h3.2l.8-4h-4V9c0-.7.3-1 1-1z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm5.5-3.2a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4z"/></svg>
                    </a>
                    <a href="https://x.com/" target="_blank" rel="noopener" aria-label="X">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.9 2H22l-6.8 7.8L23 22h-6.1l-4.8-6.2L6.7 22H3.6l7.3-8.4L3.4 2h6.3l4.3 5.7L18.9 2zm-1.1 17.9h1.7L8.8 4H7l10.8 15.9z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/" target="_blank" rel="noopener" aria-label="YouTube">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.6 7.2s-.2-1.6-.8-2.3c-.8-.8-1.7-.8-2.1-.9C15.8 3.8 12 3.8 12 3.8h0s-3.8 0-6.7.2c-.4.1-1.3.1-2.1.9-.6.7-.8 2.3-.8 2.3S2.2 9.1 2.2 11v1.8c0 1.9.2 3.8.2 3.8s.2 1.6.8 2.3c.8.8 1.9.8 2.4.9 1.7.2 6.4.2 6.4.2s3.8 0 6.7-.2c.4-.1 1.3-.1 2.1-.9.6-.7.8-2.3.8-2.3s.2-1.9.2-3.8V11c0-1.9-.2-3.8-.2-3.8zM10.1 14.8V8.3l5.9 3.3-5.9 3.2z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} {{ $settings['logo_name'] }} {{ $settings['logo_tagline'] }}. All rights reserved.</span>
            <div class="footer-bottom-links">
                <a href="#contact">Privacy Policy</a>
                <a href="#contact">Transparency</a>
                <a href="#donate">Give Support</a>
            </div>
        </div>
    </footer>

    <script>
        const slides = Array.from(document.querySelectorAll('.slide'));
        const dots = Array.from(document.querySelectorAll('.slider-dot'));
        const causeTrack = document.querySelector('.causes-track');
        const causeCards = Array.from(document.querySelectorAll('.cause-card'));
        const causeDots = Array.from(document.querySelectorAll('.cause-dot'));
        const causePrev = document.querySelector('.cause-arrow.prev');
        const causeNext = document.querySelector('.cause-arrow.next');
        const statNumbers = Array.from(document.querySelectorAll('.stat-number'));
        const impactGalleries = Array.from(document.querySelectorAll('.impact-rotating-gallery'));
        const donationForms = Array.from(document.querySelectorAll('[data-donation-form]'));
        let activeSlide = 0;
        let activeCause = 0;
        let sliderTimer = null;
        let causeTimer = null;
        let statsAnimated = false;

        function formatDonationAmount(value, currency) {
            const numericValue = Number.parseInt(value, 10) || 0;

            return currency === 'USD'
                ? `$${numericValue.toLocaleString()}`
                : `Sh${numericValue.toLocaleString()}`;
        }

        function setupDonationForms() {
            donationForms.forEach((form) => {
                const frequencyButtons = Array.from(form.querySelectorAll('[data-frequency]'));
                const frequencyInput = form.querySelector('[data-frequency-input]');
                const amountButtons = Array.from(form.querySelectorAll('[data-ugx][data-usd]'));
                const amountInput = form.querySelector('input[name="amount"]');
                const currencySelect = form.querySelector('[data-currency-select]');
                const currencyPrefix = form.querySelector('[data-currency-prefix]');
                const paymentButtons = Array.from(form.querySelectorAll('[data-payment]'));
                const paymentInput = form.querySelector('[data-payment-input]');

                function currentCurrency() {
                    return currencySelect?.value || 'UGX';
                }

                function syncAmounts() {
                    const currency = currentCurrency();

                    if (currencyPrefix) {
                        currencyPrefix.innerHTML = currency === 'USD' ? '$&nbsp;' : 'Sh&nbsp;';
                    }

                    amountButtons.forEach((button) => {
                        const amount = currency === 'USD' ? button.dataset.usd : button.dataset.ugx;
                        button.textContent = formatDonationAmount(amount, currency);
                    });
                }

                frequencyButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        frequencyButtons.forEach((option) => {
                            const isActive = option === button;
                            option.classList.toggle('active', isActive);
                            option.setAttribute('aria-pressed', String(isActive));
                        });

                        if (frequencyInput) {
                            frequencyInput.value = button.dataset.frequency || 'one-time';
                        }
                    });
                });

                amountButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        amountButtons.forEach((option) => option.classList.toggle('is-selected', option === button));

                        if (amountInput) {
                            amountInput.value = currentCurrency() === 'USD' ? button.dataset.usd : button.dataset.ugx;
                            amountInput.focus();
                        }
                    });
                });

                amountInput?.addEventListener('input', () => {
                    amountButtons.forEach((button) => button.classList.remove('is-selected'));
                });

                currencySelect?.addEventListener('change', () => {
                    syncAmounts();
                    amountButtons.forEach((button) => button.classList.remove('is-selected'));

                    if (amountInput) {
                        amountInput.value = '';
                        amountInput.placeholder = currentCurrency() === 'USD' ? '25' : '97500';
                    }
                });

                paymentButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        paymentButtons.forEach((option) => {
                            const isActive = option === button;
                            option.classList.toggle('is-selected', isActive);
                            option.setAttribute('aria-pressed', String(isActive));
                        });

                        if (paymentInput) {
                            paymentInput.value = button.dataset.payment || 'visa';
                        }
                    });
                });

                syncAmounts();
            });
        }

        function showSlide(index) {
            activeSlide = (index + slides.length) % slides.length;

            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === activeSlide);
            });

            dots.forEach((dot, dotIndex) => {
                dot.classList.toggle('is-active', dotIndex === activeSlide);
            });
        }

        function startSlider() {
            sliderTimer = window.setInterval(() => {
                showSlide(activeSlide + 1);
            }, 6500);
        }

        function visibleCauseCards() {
            if (window.matchMedia('(max-width: 640px)').matches) {
                return 1;
            }

            if (window.matchMedia('(max-width: 960px)').matches) {
                return 2;
            }

            return 3;
        }

        function showCause(index) {
            const visibleCards = visibleCauseCards();
            const maxIndex = Math.max(causeCards.length - visibleCards, 0);
            activeCause = Math.min(Math.max(index, 0), maxIndex);

            if (causeTrack && causeCards[0]) {
                const cardWidth = causeCards[0].getBoundingClientRect().width;
                const gap = Number.parseFloat(window.getComputedStyle(causeTrack).gap) || 0;
                causeTrack.style.transform = `translateX(-${activeCause * (cardWidth + gap)}px)`;
            }

            causeDots.forEach((dot, dotIndex) => {
                dot.classList.toggle('is-hidden', dotIndex > maxIndex);
                dot.classList.toggle('is-active', dotIndex === activeCause);
            });
        }

        function startCauseSlider() {
            causeTimer = window.setInterval(() => {
                const visibleCards = visibleCauseCards();
                const maxIndex = Math.max(causeCards.length - visibleCards, 0);
                showCause(activeCause >= maxIndex ? 0 : activeCause + 1);
            }, 5200);
        }

        function startImpactImageRotation() {
            impactGalleries.forEach((gallery, galleryIndex) => {
                const images = Array.from(gallery.querySelectorAll('.impact-rotating-image'));
                const dots = Array.from(gallery.querySelectorAll('.impact-image-dots span'));

                if (images.length <= 1) {
                    return;
                }

                let activeImage = images.findIndex((image) => image.classList.contains('is-active'));
                activeImage = activeImage >= 0 ? activeImage : 0;

                window.setInterval(() => {
                    images[activeImage].classList.remove('is-active');
                    dots[activeImage]?.classList.remove('is-active');

                    activeImage = (activeImage + 1) % images.length;

                    images[activeImage].classList.add('is-active');
                    dots[activeImage]?.classList.add('is-active');
                }, 6200 + (galleryIndex * 700));
            });
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                window.clearInterval(sliderTimer);
                showSlide(index);
                startSlider();
            });
        });

        causeDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                window.clearInterval(causeTimer);
                showCause(index);
                startCauseSlider();
            });
        });

        causePrev?.addEventListener('click', () => {
            window.clearInterval(causeTimer);
            const visibleCards = visibleCauseCards();
            const maxIndex = Math.max(causeCards.length - visibleCards, 0);
            showCause(activeCause <= 0 ? maxIndex : activeCause - 1);
            startCauseSlider();
        });

        causeNext?.addEventListener('click', () => {
            window.clearInterval(causeTimer);
            const visibleCards = visibleCauseCards();
            const maxIndex = Math.max(causeCards.length - visibleCards, 0);
            showCause(activeCause >= maxIndex ? 0 : activeCause + 1);
            startCauseSlider();
        });

        window.addEventListener('resize', () => {
            showCause(activeCause);
        });

        function animateStats() {
            if (statsAnimated) {
                return;
            }

            statsAnimated = true;

            statNumbers.forEach((stat) => {
                const target = Number.parseInt(stat.dataset.count, 10) || 0;
                const duration = 1400;
                const startTime = performance.now();

                function updateCount(currentTime) {
                    const progress = Math.min((currentTime - startTime) / duration, 1);
                    const easedProgress = 1 - Math.pow(1 - progress, 3);
                    stat.textContent = Math.round(target * easedProgress).toLocaleString();

                    if (progress < 1) {
                        window.requestAnimationFrame(updateCount);
                    }
                }

                window.requestAnimationFrame(updateCount);
            });
        }

        if ('IntersectionObserver' in window && statNumbers.length) {
            const statsObserver = new IntersectionObserver((entries) => {
                if (entries.some((entry) => entry.isIntersecting)) {
                    animateStats();
                    statsObserver.disconnect();
                }
            }, { threshold: 0.35 });

            statsObserver.observe(document.querySelector('.stats-section'));
        } else {
            animateStats();
        }

        startSlider();
        setupDonationForms();
        startImpactImageRotation();
        showCause(0);
        startCauseSlider();
    </script>
</body>
</html>
