SELECT
	d.driver_id, 
	SUM(CASE WHEN b.state='COMPLETED' THEN 1 ELSE 0 END) AS number_of_completed_rides,
	SUM(CASE WHEN (b.state='CANCELLED_PASSENGER' OR b.state='CANCELLED_DRIVER') THEN 1 ELSE 0 END) AS number_of_cancelled_rides,
	COUNT(DISTINCT CASE WHEN b.state='COMPLETED' THEN b.passenger_id END) AS number_of_unique_passengers,
	ROUND( SUM(CASE WHEN b.state='COMPLETED' THEN b.fare ELSE 0 END), 2 ) AS total_fare,
	ROUND( SUM(CASE WHEN b.state='COMPLETED' THEN b.fare ELSE 0 END) * 0.2, 2 ) AS total_commission
FROM
	drivers d
	JOIN bookings b ON (b.driver_id=d.driver_id)
WHERE
	d.email LIKE '%fvtaxi%' OR d.email LIKE '%fvdrive%';
GROUP BY
	driver_id
HAVING
	number_of_completed_rides > 10
	AND number_of_unique_passengers < 5
ORDER BY
	number_of_completed_rides DESC;