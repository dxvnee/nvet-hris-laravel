<style>
    :root {
        --primary: #855E41;
        --primary-dark: #553820;
        --primary-light: #a8845e;
        --text: #111827;
        --text-secondary: #374151;
        --muted: #6b7280;
        --light-muted: #9ca3af;
        --border: #e5e7eb;
        --border-light: #f3f4f6;
        --bg: #f6f7fb;
        --card: #ffffff;
        --positive: #059669;
        --positive-bg: #ecfdf5;
        --negative: #dc2626;
        --negative-bg: #fef2f2;
        --warning: #d97706;
        --warning-bg: #fffbeb;
        --accent: #8b5cf6;
        --accent-bg: #f5f3ff;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', system-ui, -apple-system, Roboto, Helvetica, Arial, sans-serif;
        background: var(--bg);
        color: var(--text);
        font-size: 12px;
        line-height: 1.6;
        -webkit-font-smoothing: antialiased;
        font-variant-numeric: tabular-nums;
    }

    .container {
        max-width: 780px;
        margin: 24px auto;
        background: var(--card);
        padding: 0;
        border-radius: 16px;
        border: 1px solid rgba(133, 94, 65, 0.12);
        box-shadow: 0 4px 24px rgba(17, 24, 39, 0.06), 0 1px 3px rgba(17, 24, 39, 0.04);
        overflow: hidden;
    }

    /* Header */
    .header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 28px 36px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .company-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .company-logo-image {
        width: 44px;
        height: 44px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .company-logo {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }

    .company-text h1 {
        font-size: 22px;
        font-weight: 700;
        letter-spacing: -0.02em;
        margin-bottom: 2px;
    }

    .company-text p {
        font-size: 10.5px;
        opacity: 0.8;
        line-height: 1.4;
    }

    .slip-info {
        text-align: right;
    }

    .slip-info .slip-title {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        opacity: 0.7;
        margin-bottom: 2px;
    }

    .slip-info .slip-heading {
        font-size: 20px;
        font-weight: 700;
        letter-spacing: 0.04em;
        margin-bottom: 6px;
    }

    .slip-meta {
        font-size: 11px;
        opacity: 0.85;
        line-height: 1.5;
    }

    .status-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-top: 4px;
    }

    .status-final {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }

    .status-draft {
        background: rgba(251, 191, 36, 0.3);
        color: #fef3c7;
    }

    /* Body Content */
    .body-content {
        padding: 28px 36px 20px;
    }

    /* Employee Section */
    .employee-section {
        display: flex;
        align-items: center;
        gap: 20px;
        background: linear-gradient(135deg, #faf8f6, #f5f0eb);
        border: 1px solid rgba(133, 94, 65, 0.1);
        padding: 20px 24px;
        border-radius: 12px;
        margin-bottom: 28px;
    }

    .employee-photo {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(133, 94, 65, 0.2);
        flex-shrink: 0;
    }

    .employee-main {
        flex: 1;
        min-width: 0;
    }

    .employee-name {
        font-size: 17px;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 4px;
    }

    .employee-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        font-size: 11px;
        color: var(--muted);
    }

    .employee-meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .employee-meta-item svg {
        width: 13px;
        height: 13px;
        opacity: 0.6;
    }

    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .badge-dokter {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .badge-paramedis {
        background: #dbeafe;
        color: #2563eb;
    }

    .badge-tech {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-fo {
        background: #ffedd5;
        color: #ea580c;
    }

    /* Section Card */
    .section-card {
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .section-card-header {
        background: linear-gradient(135deg, #faf8f6, #f5f1ec);
        padding: 12px 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-card-header .card-icon {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    .section-card-header .card-icon.gaji {
        background: rgba(5, 150, 105, 0.1);
        color: var(--positive);
    }

    .section-card-header .card-icon.insentif {
        background: rgba(139, 92, 246, 0.1);
        color: var(--accent);
    }

    .section-card-header h3 {
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
        letter-spacing: -0.01em;
    }

    .section-card-body {
        padding: 0;
    }

    /* Subsection */
    .subsection {
        padding: 16px 20px;
        border-bottom: 1px solid var(--border-light);
    }

    .subsection:last-child {
        border-bottom: none;
    }

    .subsection-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .subsection-title .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .dot-green {
        background: var(--positive);
    }

    .dot-red {
        background: var(--negative);
    }

    .dot-orange {
        background: var(--warning);
    }

    .dot-purple {
        background: var(--accent);
    }

    .dot-blue {
        background: #2563eb;
    }

    /* Tables */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table td {
        padding: 7px 0;
        vertical-align: top;
    }

    .data-table .label {
        color: var(--text-secondary);
        font-size: 11.5px;
    }

    .data-table .value {
        text-align: right;
        font-weight: 500;
        font-size: 11.5px;
        white-space: nowrap;
    }

    .data-table .sub-label {
        padding-left: 16px;
        font-size: 10px;
        color: var(--light-muted);
        padding-top: 0;
        padding-bottom: 8px;
    }

    .data-table .positive {
        color: var(--positive);
    }

    .data-table .negative {
        color: var(--negative);
    }

    .data-table .accent {
        color: var(--accent);
    }

    .data-table .muted-value {
        color: var(--muted);
    }

    .data-table .separator td {
        padding: 0;
        height: 1px;
        background: var(--border-light);
    }

    /* Detail Box */
    .detail-box {
        background: #fafafa;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 12px 14px;
        margin-top: 6px;
        margin-bottom: 4px;
    }

    .detail-box table {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-box td {
        padding: 4px 0;
        font-size: 10.5px;
        color: var(--text-secondary);
    }

    .detail-box td:last-child {
        text-align: right;
        font-weight: 500;
    }

    .detail-box .detail-note {
        font-style: italic;
        color: var(--light-muted);
        font-size: 10px;
        padding-left: 12px;
    }

    /* Subtotal Row */
    .subtotal-row {
        background: linear-gradient(135deg, #faf8f6, #f5f1ec);
        padding: 14px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--border);
    }

    .subtotal-row .subtotal-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-secondary);
    }

    .subtotal-row .subtotal-value {
        font-size: 15px;
        font-weight: 700;
    }

    .subtotal-positive {
        color: var(--positive);
    }

    .subtotal-negative {
        color: var(--negative);
    }

    /* Note Section */
    .note-section {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        background: var(--warning-bg);
        border: 1px solid rgba(217, 119, 6, 0.15);
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .note-icon {
        font-size: 16px;
        flex-shrink: 0;
        line-height: 1;
        margin-top: 1px;
    }

    .note-section h5 {
        color: #92400e;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 3px;
    }

    .note-section p {
        color: #78350f;
        font-size: 11px;
        line-height: 1.5;
    }

    /* Total Section */
    .total-section {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 12px;
        padding: 24px 28px;
        margin-bottom: 28px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .total-section::before {
        content: "";
        position: absolute;
        top: -20px;
        right: -20px;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
    }

    .total-section::after {
        content: "";
        position: absolute;
        bottom: -30px;
        left: -30px;
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.04);
        border-radius: 50%;
    }

    .total-breakdown {
        display: flex;
        gap: 0;
        margin-bottom: 16px;
        position: relative;
        z-index: 1;
    }

    .total-breakdown-item {
        flex: 1;
        text-align: center;
        padding: 10px 12px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 8px;
    }

    .total-breakdown-item:first-child {
        margin-right: 8px;
    }

    .total-breakdown-item .bd-label {
        font-size: 9.5px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        opacity: 0.7;
        margin-bottom: 4px;
    }

    .total-breakdown-item .bd-value {
        font-size: 14px;
        font-weight: 700;
    }

    .total-main {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        position: relative;
        z-index: 1;
    }

    .total-main .total-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        opacity: 0.8;
    }

    .total-main .total-value {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    /* Footer */
    .footer {
        display: flex;
        justify-content: space-between;
        padding: 0;
        margin-bottom: 8px;
    }

    .signature-box {
        text-align: center;
        width: 200px;
    }

    .signature-box p {
        font-size: 11px;
        color: var(--muted);
    }

    .signature-line {
        border-top: 1px solid var(--text);
        margin-top: 56px;
        padding-top: 8px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text);
    }

    .print-timestamp {
        text-align: center;
        color: var(--light-muted);
        font-size: 9.5px;
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid var(--border-light);
    }

    /* Print Button */
    .print-button {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 14px 28px;
        border: none;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(133, 94, 65, 0.4);
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        z-index: 100;
    }

    .print-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(133, 94, 65, 0.5);
    }

    /* Print Media */
    @media print {
        body {
            background: white;
            font-size: 11px;
        }

        .container {
            margin: 0;
            box-shadow: none;
            border: none;
            border-radius: 0;
        }

        .no-print {
            display: none !important;
        }

        @page {
            margin: 8mm;
            size: A4;
        }

        .header {
            background: var(--primary) !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .total-section {
            background: var(--primary) !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .section-card-header,
        .subtotal-row {
            background: #f8f6f4 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .employee-section {
            background: #faf8f6 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .detail-box {
            background: #fafafa !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .note-section {
            background: #fffbeb !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .total-breakdown-item {
            background: rgba(255, 255, 255, 0.1) !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .badge,
        .status-badge {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .section-card {
            break-inside: avoid;
        }

        .footer {
            break-inside: avoid;
        }
    }
</style>
