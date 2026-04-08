@props(['type' => 'success', 'message'])

@php
    $colors = [
        'success' => '#d4edda',
        'error' => '#f8d7da',
        'warning' => '#fff3cd',
        'info' => '#d1ecf1'
    ];

    $textColors = [
        'success' => '#155724',
        'error' => '#721c24',
        'warning' => '#856404',
        'info' => '#0c5460'
    ];
@endphp

<div id="alert-box"
     style="
        padding:12px;
        margin:10px 0;
        border-radius:6px;
        background: {{ $colors[$type] ?? '#d4edda' }};
        color: {{ $textColors[$type] ?? '#155724' }};
        position: relative;
        animation: fadeIn 0.5s;
     ">

    {{ $message }}

    <span onclick="this.parentElement.style.display='none'"
          style="
            position:absolute;
            right:10px;
            top:5px;
            cursor:pointer;
            font-weight:bold;
          ">
        ×
    </span>
</div>

<style>
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-10px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

<script>
    setTimeout(() => {
        let alert = document.getElementById('alert-box');
        if(alert){
            alert.style.transition = "0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>