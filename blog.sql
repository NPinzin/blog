-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 07:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(0, 'Deleted'),
(1, 'Tv'),
(2, 'Politics'),
(3, 'Science'),
(4, 'General'),
(5, 'Geography'),
(6, 'Math'),
(7, 'Sports'),
(8, 'Finance'),
(9, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `public` int(11) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `comment`, `public`, `timestamp`) VALUES
(24, 1, 4, '<p>I too love Math! Prime numbers are cool</p>', 1, '2023-04-10'),
(25, 1, 2, '<p>What a well written article!</p>', 1, '2023-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `post` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `public` int(11) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`, `post`, `category_id`, `public`, `timestamp`) VALUES
(1, 2, 'The War in Ukraine: A Complex Conflict with No Easy Solutions', '<p>The conflict in Ukraine began in 2014 when protests erupted against then-President Viktor Yanukovych, who had rejected a proposed EU association agreement in favor of closer ties with Russia. The protests led to Yanukovych\'s ousting and the installation of a pro-Western government. However, this sparked a backlash from pro-Russian separatists in the eastern regions of Donetsk and Luhansk, who declared independence from Ukraine and sought annexation by Russia.</p><p>Since then, the conflict has escalated into a full-blown war, with both sides accusing each other of human rights violations, war crimes, and territorial aggression. The conflict has claimed over 13,000 lives and displaced millions, with many civilians caught in the crossfire.</p><p>The conflict has also become a geopolitical flashpoint, with Russia backing the separatists and Western powers supporting the Ukrainian government. The conflict has strained relations between Russia and the West, with the latter imposing economic sanctions on Russia over its alleged role in the conflict.</p><p>Attempts at a diplomatic resolution have been largely unsuccessful, with ceasefires repeatedly broken and peace talks stalling. The Minsk agreements, signed in 2015, aimed to end the conflict by implementing a ceasefire, withdrawing heavy weapons, and granting greater autonomy to the separatist regions. However, the agreements have not been fully implemented, and fighting continues to this day.</p><p>The conflict has had a devastating impact on the people of Ukraine, particularly those living in the conflict zone. Civilians have been killed, injured, and traumatized, while infrastructure and homes have been destroyed. The conflict has also exacerbated Ukraine\'s economic woes, with the country suffering from high unemployment, inflation, and debt.&nbsp;</p><p>The war in Ukraine remains a complex and ongoing conflict, with no easy solutions. The international community must continue to work towards a peaceful resolution that respects the sovereignty and territorial integrity of Ukraine, while addressing the legitimate concerns of all parties involved.</p>', 5, 1, '2023-03-30'),
(2, 2, 'The Fight for Women\'s Rights: Progress and Challenges Ahead', '<p>Women\'s rights have come a long way in the past century, but there is still much work to be done to achieve true gender equality. Women have made significant gains in areas such as education, employment, and political representation, but they continue to face discrimination and barriers to their full participation in society. One of the most pressing issues in the fight for women\'s rights is violence against women. One in three women worldwide has experienced physical or sexual violence, and many more have faced other forms of gender-based violence such as harassment and discrimination. Governments and civil society organizations must work together to address this issue through legislation, education, and support services for survivors. Another area of concern is women\'s economic empowerment. Women still earn less than men on average, and they are overrepresented in low-paying, precarious work. Access to education, training, and financial services is essential for women to achieve economic independence and security. Political representation is also crucial for advancing women\'s rights. Women are underrepresented in political leadership positions, making up just 25% of national parliamentarians worldwide. Quotas and other affirmative action measures can help to increase women\'s participation in politics, but cultural and social barriers must also be addressed to ensure that women can fully participate in decision-making processes. In recent years, the #MeToo movement has shed light on the prevalence of sexual harassment and assault and sparked a global conversation about women\'s experiences of gender-based violence. However, backlash to the movement and the continued prevalence of gender-based violence demonstrate that the fight for women\'s rights is far from over. The fight for women\'s rights is a complex and ongoing struggle that requires the commitment and involvement of all members of society. Through education, advocacy, and policy change, we can work towards a future where all women have the opportunity to live free from violence and discrimination, and to fully participate in all aspects of society.</p>', 2, 1, '2023-03-30'),
(3, 2, 'The Importance of Science in Our Changing World', '<p>Science plays a critical role in our rapidly changing world, providing insights and solutions to some of the most pressing challenges we face. From climate change to global pandemics, science is essential for understanding complex systems and developing effective responses. One of the most significant challenges facing humanity is climate change. Science has shown us that human activity is causing the planet to warm at an alarming rate, with devastating consequences for ecosystems and human communities. Through scientific research, we can develop new technologies and strategies for mitigating the impacts of climate change and transitioning to a more sustainable future. Science is also essential for understanding and responding to global pandemics such as COVID-19. Scientists around the world have worked tirelessly to develop vaccines and treatments for the virus, using cutting-edge technologies and collaboration across borders. The pandemic has highlighted the importance of investing in scientific research and building resilient health systems to protect against future outbreaks. In addition to addressing global challenges, science has also contributed to advancements in fields such as medicine, technology, and agriculture. Scientific research has led to the development of life-saving treatments and diagnostic tools, improved communication technologies, and sustainable farming practices, among many other innovations. Despite its many contributions, science is sometimes subject to skepticism and political interference. Anti-science sentiment and misinformation can undermine public trust in scientific research, while political interference in scientific decision-making can compromise the integrity of scientific processes. As we face the challenges of the 21st century, it is more important than ever to recognize the critical role that science plays in shaping our world. By investing in scientific research, supporting evidence-based decision-making, and promoting scientific literacy, we can harness the power of science to create a more just, equitable, and sustainable future.</p>', 3, 1, '2023-03-30'),
(4, 2, 'Breakthrough in Number Theory: The Discovery of a New Prime Number', '<p>Mathematicians around the world are celebrating a major breakthrough in number theory with the recent discovery of a new prime number. The discovery of this new prime number has set a new record for the largest prime number ever discovered, with the number containing a staggering 24,862,048 digits. Prime numbers are a fundamental concept in number theory, with many important applications in cryptography and computer science. They are numbers that are only divisible by 1 and themselves, and they play a crucial role in modern encryption methods used to protect sensitive information. The discovery of this new prime number was made using a distributed computing project called the Great Internet Mersenne Prime Search (GIMPS), which harnesses the computing power of volunteers around the world to search for new prime numbers. The search for this new prime number took over four years and involved millions of hours of computing time. The discovery of this new prime number is a significant achievement for mathematicians, as it provides new insights into the properties of prime numbers and the nature of mathematical patterns. It is also a testament to the power of distributed computing and the collaborative efforts of mathematicians around the world. While the discovery of this new prime number may seem abstract and esoteric, it has important practical implications. Prime numbers are used extensively in modern encryption methods, and the discovery of a new prime number with such a large number of digits could help to improve the security of these methods and protect against cyber attacks. Overall, the discovery of this new prime number is a testament to the importance of mathematics and the ongoing quest to understand the fundamental principles that govern our universe. It is an exciting time for number theory, and the discovery of this new prime number is sure to inspire further research and discovery in the field.</p>', 6, 1, '2023-03-30'),
(53, 1, 'Researchers Introduce Groundbreaking New Concept in Computer Science: Quantum Machine Learning', '<p>Computer scientists and physicists have long been exploring the potential of quantum computing to revolutionize the way we process and analyze information. Now, researchers have introduced a groundbreaking new concept in computer science that combines quantum computing and machine learning, known as quantum machine learning.</p><p>Quantum machine learning involves using quantum computing algorithms to improve machine learning models and algorithms. This new concept holds tremendous potential for solving complex problems in fields such as finance, healthcare, and artificial intelligence.</p><p>One of the key advantages of quantum machine learning is its ability to process and analyze vast amounts of data more efficiently than classical computing methods. This is because quantum computing can leverage the principles of superposition and entanglement to perform multiple computations simultaneously, allowing for faster and more accurate data analysis.</p><p>Another advantage of quantum machine learning is its potential for solving problems that are too complex for classical computing methods. This includes tasks such as natural language processing, image recognition, and predictive modeling.</p><p>While the concept of quantum machine learning is still in its early stages, researchers around the world are already exploring its potential applications. Some of these applications include improving the accuracy of financial forecasting models, developing more effective drug treatments, and enhancing the capabilities of artificial intelligence systems.</p><p>Despite its many potential benefits, there are also challenges associated with quantum machine learning. One of the biggest challenges is the difficulty of building and maintaining reliable quantum computing hardware, which is still in the early stages of development.</p><p>However, researchers remain optimistic about the potential of quantum machine learning to transform the way we process and analyze data. As the field continues to evolve, it is likely that we will see exciting new developments and applications emerge in the years to come.</p>', 6, 1, '2023-04-10'),
(54, 3, 'Critics Rave about New Sci-Fi Series \'Future Horizons\'', '<p>Sci-fi fans have been eagerly anticipating the premiere of the new TV series \'Future Horizons\', and the show has not disappointed. Critics are raving about the series, which has been praised for its imaginative storytelling, stunning visuals, and exceptional performances.</p><p>The show is set in a future world where humanity has colonized other planets and established interstellar travel. The story follows a group of explorers who embark on a mission to a distant planet in search of new resources and opportunities. Along the way, they encounter a host of challenges and dangers, including hostile alien life forms, treacherous terrain, and internal conflicts.</p><p>What sets \'Future Horizons\' apart from other sci-fi shows is its attention to detail and its emphasis on character development. The show\'s creators have gone to great lengths to create a fully-realized world, with intricate sets, costumes, and special effects that bring the futuristic setting to life. At the same time, the characters are well-developed and multi-dimensional, with complex backstories and motivations that add depth and nuance to the story.</p><p>The show\'s cast is also receiving high praise, with standout performances from both established actors and relative newcomers. The lead role is played by rising star Emma Rodriguez, who brings a fierce determination and vulnerability to her portrayal of the intrepid explorer. Other notable performances come from veteran actors like James Wilson and Rachel Park, who bring gravitas and depth to their respective roles.</p><p>Overall, \'Future Horizons\' is shaping up to be one of the most exciting and innovative sci-fi shows of recent years. With its engaging storytelling, stunning visuals, and exceptional performances, the series is sure to captivate audiences and leave them eagerly anticipating each new episode.</p>', 1, 1, '2023-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(33) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(33) NOT NULL,
  `firstName` varchar(33) NOT NULL,
  `lastName` varchar(33) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `firstName`, `lastName`, `level_id`) VALUES
(1, 'NickP24', '$2y$10$EKU0R0bkJZcg/GwjCrimU.nqrWYZlel9R9g6IsHxPJOQM1Lw4uZvG', 'nick@pinzin.ca', 'Nick', 'Pinzin', 0),
(2, 'Chatgpt', '$2y$10$d2D5pClfU2NZvDnsEvWg7.Ufe8biilImwo8JAFSXnFXoN.jV7FAES', 'chatgpt@openai.com', 'Chat', 'GPT', 0),
(3, 'admin', '$2y$10$mMOe63WKLH9Z/65EubLu/OcSMyPVfYa9YlMpZSNrgu/5G56p4dSty', 'admin@admin.com', 'admin', 'admin', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
