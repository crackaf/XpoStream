--
-- Dumping data for table `host_streams`
--

INSERT INTO `host_streams` (`stream_id`, `user_id`, `stream_name`, `stream_link`, `stream_slot`, `stream_type`) VALUES
(1, 1, 'Quintuplets Ending Song', 'https://www.youtube.com/embed/s6k3mW0Kgls', 1, 'free'),
(2, 1, 'Shadows House Ending Song', 'https://www.youtube.com/embed/tfcfJj7LZCk', 2, 'paid');



--
-- Dumping data for table `host_subscribers`
--

INSERT INTO `host_subscribers` (`host_user_id`, `subscribed_user_id`) VALUES
(1, 2);


--
-- Dumping data for table `stream_slots`
--

INSERT INTO `stream_slots` (`slot_id`, `timestamp`) VALUES
(1, '2021-05-19 19:00:00'),
(2, '2021-05-27 03:00:00'),
(3, '2021-05-28 03:00:00'),
(4, '2021-06-29 03:00:00');



--
-- Dumping data for table `stream_subscriptions`
--

INSERT INTO `stream_subscriptions` (`stream_id`, `user_id`) VALUES
(1, 2);



--
-- Dumping data for table `users_list`
--

INSERT INTO `users_list` (`user_id`, `email`, `name`, `password`, `reg_type`, `date`) VALUES
(1, 'zeerak@animecorner.me', 'Zeerak Ahmad', 'zeerak', 'host', '2021-05-24 07:39:36'),
(2, 'arbab@animecorner.me', 'Arbab Hamd Rizwan', 'arbab', 'viewer', '2021-05-25 09:25:08');