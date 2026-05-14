// STATUS TOGGLE
document.getElementById('statusToggle')?.addEventListener('click', function() {
    this.classList.toggle('online');

    const isOnline = this.classList.contains('online');

    this.innerHTML = isOnline 
        ? '<i class="fas fa-circle" style="font-size:0.7rem;"></i> Online'
        : '<i class="fas fa-circle" style="font-size:0.7rem;color:#EF4444;"></i> Offline';
});

console.log('☕ BrewHaven Driver Dashboard Ready!');
console.log('🔄 Status toggle working');
console.log('📱 JS file connected successfully');