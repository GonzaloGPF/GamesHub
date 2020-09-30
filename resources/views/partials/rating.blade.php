<script>
@if($event)
    window.livewire.on('{{ $event }}', params => {
        new ProgressBar.Circle(document.getElementById(params.slug), {
            color: 'white',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 6,
            trailWidth: 3,
            trailColor: '#4A5568',
            easing: 'easeInOut',
            duration: 2000,
            text: {
                autoStyleContainer: false
            },
            from: {color: '#A00', width: 6},
            to: {color: '#0A0', width: 6},
            // Set default step function for all animate calls
            step: function (state, circle) {
                circle.path.setAttribute('stroke', state.color);
                circle.path.setAttribute('stroke-width', state.width);

                let value = Math.round(circle.value() * 100);
                if (value === 0) {
                    circle.setText('0%');
                } else {
                    circle.setText(value + '%');
                }

            }
        }).animate(params.rating);
    })
@endif
</script>