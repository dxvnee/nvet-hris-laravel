<style>
    :root {
        --primary: #855E41;
        --primary-2: #6C4A34;
        --text: #111827;
        --muted: #6b7280;
        --border: #e5e7eb;
        --bg: #f6f7fb;
        --card: #ffffff;
        --positive: #16a34a;
        --negative: #dc2626;
        --warning: #f59e0b;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
        background: var(--bg);
        color: var(--text);
        font-size: 12px;
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
        font-variant-numeric: tabular-nums;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background: var(--card);
        padding: 40px;
        border-radius: 16px;
        border: 1px solid rgba(17, 24, 39, 0.06);
        box-shadow: 0 10px 30px rgba(17, 24, 39, 0.08);
        position: relative;
        overflow: hidden;
    }

    .container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--primary), var(--primary-2));
    }

    @media print {
        body {
            background: white;
        }
        .container {
            margin: 0;
            padding: 20px;
            box-shadow: none;
            border: none;
            border-radius: 0;
        }
        .container::before {
            display: none;
        }
        .no-print {
            display: none !important;
        }
        @page {
            margin: 10mm;
        }
        .employee-section,
        .insentif-detail,
        .note-section {
            background: #fff !important;
        }
        .employee-section {
            border: 1px solid var(--border);
        }
        .total-section {
            background: #fff !important;
            color: var(--text) !important;
            border: 2px solid var(--primary);
        }
        .total-section .breakdown {
            opacity: 1;
            color: var(--muted);
        }
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid var(--border);
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .company-info h1 {
        font-size: 26px;
        color: var(--primary);
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .company-info p {
        color: var(--muted);
        font-size: 11px;
    }

    .slip-info {
        text-align: right;
    }

    .slip-info h2 {
        font-size: 18px;
        color: var(--text);
        font-weight: 600;
        letter-spacing: 0.06em;
    }

    .slip-info p {
        color: var(--muted);
        font-size: 12px;
    }

    .employee-section {
        display: flex;
        gap: 40px;
        background: #f8fafc;
        border: 1px solid var(--border);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .employee-photo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(133, 94, 65, 0.25);
    }

    .employee-details {
        flex: 1;
    }

    .employee-details h3 {
        font-size: 18px;
        color: var(--primary);
        margin-bottom: 5px;
    }

    .employee-details table {
        width: 100%;
    }

    .employee-details td {
        padding: 3px 0;
        vertical-align: top;
    }

    .employee-details td:first-child {
        width: 120px;
        color: var(--muted);
    }

    .badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        border: 1px solid rgba(17, 24, 39, 0.08);
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .badge-dokter { background: #f3e8ff; color: #7c3aed; }
    .badge-paramedis { background: #dbeafe; color: #2563eb; }
    .badge-tech { background: #dcfce7; color: #16a34a; }
    .badge-fo { background: #ffedd5; color: #ea580c; }

    .salary-section {
        margin-bottom: 25px;
    }

    .salary-section h4 {
        font-size: 14px;
        color: var(--text);
        margin-bottom: 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .salary-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
    }

    .salary-table td {
        padding: 10px 14px;
        border-bottom: 1px solid #f3f4f6;
    }

    .salary-table tr:nth-child(even) td {
        background: #fafafa;
    }

    .salary-table tr:last-child td {
        border-bottom: none;
    }

    .salary-table .label {
        color: #374151;
    }

    .salary-table .value {
        text-align: right;
        font-weight: 500;
    }

    .salary-table .positive {
        color: var(--positive);
    }

    .salary-table .negative {
        color: var(--negative);
    }

    .salary-table .sub-label {
        padding-left: 30px;
        font-size: 11px;
        color: var(--muted);
    }

    .insentif-detail {
        background: #f9fafb;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 15px;
        margin: 10px 0;
    }

    .insentif-detail table {
        width: 100%;
    }

    .insentif-detail td {
        padding: 5px 0;
        font-size: 11px;
    }

    .total-section {
        background: linear-gradient(135deg, var(--primary), var(--primary-2));
        color: white;
        padding: 25px;
        border-radius: 12px;
        margin-top: 30px;
    }

    .total-section table {
        width: 100%;
    }

    .total-section td {
        padding: 5px 0;
    }

    .total-section .total-label {
        font-size: 16px;
    }

    .total-section .total-value {
        text-align: right;
        font-size: 28px;
        font-weight: 700;
    }

    .total-section .breakdown {
        font-size: 11px;
        opacity: 0.9;
    }

    .footer {
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
    }

    .signature-box {
        text-align: center;
        width: 200px;
    }

    .signature-line {
        border-top: 1px solid #111827;
        margin-top: 60px;
        padding-top: 8px;
    }

    .print-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--primary);
        color: white;
        padding: 15px 30px;
        border: none;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(133, 94, 65, 0.4);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .print-button:hover {
        background: #553820;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-final {
        background: #dcfce7;
        color: #16a34a;
    }

    .status-draft {
        background: #fef3c7;
        color: #d97706;
    }

    .note-section {
        background: #fffbeb;
        border-left: 4px solid #f59e0b;
        padding: 15px;
        margin-top: 20px;
        border-radius: 0 8px 8px 0;
    }

    .note-section h5 {
        color: #92400e;
        margin-bottom: 5px;
        font-size: 12px;
    }

    .note-section p {
        color: #78350f;
        font-size: 11px;
    }
</style>
