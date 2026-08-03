<h2>Your Booking has been Promoted</h2>
<p>Dear <?php echo e($promotedBooking->user->name); ?>,</p>
<p>We are pleased to inform you that your booking for the trip
<strong><?php echo e($promotedBooking->trip->title); ?></strong>
has been promoted from the waiting list to a confirmed booking.</p>
<?php /**PATH C:\xampp\htdocs\Xacademy Tasks\TripGo\resources\views/emails/Booking_Promoted_Mail.blade.php ENDPATH**/ ?>