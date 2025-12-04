-- ============================================
-- DIU CIS Club - Realistic Demo Data
-- 15+ entries for each category with real images
-- ============================================

USE cisclub_portal;

-- ============================================
-- 1. USERS (20 Active Members)
-- ============================================
INSERT INTO users (full_name, email, username, password, phone, student_id, status) VALUES
('Fahim Ahmed', 'fahim.ahmed@diu.edu.bd', 'fahim_ahmed', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1712-345678', '201-35-678', 'active'),
('Nusrat Jahan', 'nusrat.jahan@diu.edu.bd', 'nusrat_j', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1812-345679', '201-35-679', 'active'),
('Rakib Hasan', 'rakib.hasan@diu.edu.bd', 'rakib_h', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1912-345680', '201-35-680', 'active'),
('Tasnim Rahman', 'tasnim.rahman@diu.edu.bd', 'tasnim_r', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1712-345681', '201-35-681', 'active'),
('Shakib Khan', 'shakib.khan@diu.edu.bd', 'shakib_k', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1812-345682', '201-35-682', 'active'),
('Mehjabin Chowdhury', 'mehjabin.c@diu.edu.bd', 'mehjabin_c', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1912-345683', '201-35-683', 'active'),
('Tanvir Islam', 'tanvir.islam@diu.edu.bd', 'tanvir_i', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1712-345684', '201-35-684', 'active'),
('Ayesha Siddiqua', 'ayesha.s@diu.edu.bd', 'ayesha_s', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1812-345685', '201-35-685', 'active'),
('Mahbub Alam', 'mahbub.alam@diu.edu.bd', 'mahbub_a', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1912-345686', '201-35-686', 'active'),
('Farzana Akter', 'farzana.akter@diu.edu.bd', 'farzana_a', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1712-345687', '201-35-687', 'active'),
('Imran Hossain', 'imran.hossain@diu.edu.bd', 'imran_h', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1812-345688', '201-35-688', 'active'),
('Sabrina Ahmed', 'sabrina.ahmed@diu.edu.bd', 'sabrina_a', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1912-345689', '201-35-689', 'active'),
('Asif Rahman', 'asif.rahman@diu.edu.bd', 'asif_r', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1712-345690', '201-35-690', 'active'),
('Tahmina Begum', 'tahmina.begum@diu.edu.bd', 'tahmina_b', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1812-345691', '201-35-691', 'active'),
('Nafis Ahmed', 'nafis.ahmed@diu.edu.bd', 'nafis_a', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1912-345692', '201-35-692', 'active'),
('Sharmila Islam', 'sharmila.islam@diu.edu.bd', 'sharmila_i', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1712-345693', '201-35-693', 'active'),
('Kamal Uddin', 'kamal.uddin@diu.edu.bd', 'kamal_u', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1812-345694', '201-35-694', 'active'),
('Rupa Akter', 'rupa.akter@diu.edu.bd', 'rupa_a', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1912-345695', '201-35-695', 'active'),
('Sohel Rana', 'sohel.rana@diu.edu.bd', 'sohel_r', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1712-345696', '201-35-696', 'active'),
('Mim Akter', 'mim.akter@diu.edu.bd', 'mim_a', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+880 1812-345697', '201-35-697', 'active');

-- ============================================
-- 2. EVENTS (20 Events with Real Tech Images)
-- ============================================
INSERT INTO events (event_name, description, category_id, date_start, date_end, time_start, location, image, max_participants, status) VALUES
('Python Programming Bootcamp 2025', 'Intensive 5-day Python programming bootcamp covering basics to advanced topics including Django and Flask frameworks.', 1, '2025-01-15', '2025-01-19', '09:00:00', 'Room 401, Building-A', 'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=800', 50, 'upcoming'),
('AI & Machine Learning Workshop', 'Hands-on workshop on Artificial Intelligence and Machine Learning using Python, TensorFlow, and Scikit-learn.', 1, '2025-01-22', '2025-01-22', '10:00:00', 'Computer Lab 3', 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800', 40, 'upcoming'),
('Web Development with React', 'Learn modern web development with React.js, Redux, and Node.js. Build real-world projects.', 1, '2025-02-05', '2025-02-07', '14:00:00', 'Lab 205, IT Building', 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800', 45, 'upcoming'),
('National Programming Contest 2025', 'Annual inter-university programming competition. Teams of 3 members. Prizes worth BDT 50,000.', 2, '2025-02-15', '2025-02-15', '09:00:00', 'University Auditorium', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800', 100, 'upcoming'),
('Cybersecurity Fundamentals', 'Learn ethical hacking, network security, and penetration testing basics from industry experts.', 1, '2025-02-20', '2025-02-21', '10:00:00', 'Room 301, CSE Building', 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800', 35, 'upcoming'),
('Mobile App Development Masterclass', 'Build Android and iOS apps using Flutter and React Native. Includes deployment strategies.', 1, '2025-03-01', '2025-03-03', '13:00:00', 'Software Lab 1', 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800', 40, 'upcoming'),
('Tech Talk: Cloud Computing with AWS', 'Industry expert seminar on Amazon Web Services, cloud architecture, and DevOps practices.', 3, '2025-03-10', '2025-03-10', '15:00:00', 'Seminar Hall 2', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800', 80, 'upcoming'),
('Hackathon 2025: Code for Change', '24-hour hackathon focused on solving real-world problems. Amazing prizes and networking opportunities.', 2, '2025-03-20', '2025-03-21', '08:00:00', 'Main Campus Ground', 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800', 120, 'upcoming'),
('Database Management Systems Workshop', 'Deep dive into SQL, NoSQL, MongoDB, and PostgreSQL. Learn query optimization and database design.', 1, '2025-03-25', '2025-03-26', '10:00:00', 'Lab 302, IT Building', 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=800', 45, 'upcoming'),
('UI/UX Design Masterclass', 'Learn user interface and user experience design principles using Figma and Adobe XD.', 1, '2025-04-05', '2025-04-06', '14:00:00', 'Design Lab', 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800', 30, 'upcoming'),
('Blockchain & Cryptocurrency Seminar', 'Understanding blockchain technology, smart contracts, and cryptocurrency ecosystems.', 3, '2025-04-12', '2025-04-12', '16:00:00', 'Auditorium', 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800', 60, 'upcoming'),
('Data Science with Python', 'Comprehensive workshop on data analysis, visualization, and predictive modeling using Python libraries.', 1, '2025-04-18', '2025-04-20', '09:00:00', 'Data Science Lab', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800', 40, 'upcoming'),
('Git & GitHub for Beginners', 'Version control fundamentals, collaborative coding, and open-source contribution workshop.', 1, '2025-04-25', '2025-04-25', '11:00:00', 'Room 201', 'https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=800', 50, 'upcoming'),
('Career Fair 2025', 'Meet with top tech companies, submit resumes, and attend interview preparation sessions.', 5, '2025-05-01', '2025-05-02', '09:00:00', 'University Ground', 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800', 200, 'upcoming'),
('IoT Workshop: Smart Home Systems', 'Build IoT projects using Arduino, Raspberry Pi, and sensors. Create your own smart home prototype.', 1, '2025-05-10', '2025-05-11', '10:00:00', 'Electronics Lab', 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?w=800', 35, 'upcoming'),
('DevOps & CI/CD Pipeline Workshop', 'Learn Docker, Kubernetes, Jenkins, and automated deployment strategies for modern applications.', 1, '2025-05-15', '2025-05-16', '13:00:00', 'Lab 404', 'https://images.unsplash.com/photo-1667372393119-3d4c48d07fc9?w=800', 40, 'upcoming'),
('Annual Tech Fest 2025', 'Grand celebration with tech exhibitions, competitions, cultural programs, and award ceremonies.', 4, '2025-05-25', '2025-05-27', '08:00:00', 'Entire Campus', 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800', 500, 'upcoming'),
('Game Development with Unity', 'Create 2D and 3D games using Unity engine and C#. Learn game mechanics and monetization.', 1, '2025-06-01', '2025-06-03', '14:00:00', 'Gaming Lab', 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=800', 30, 'upcoming'),
('Digital Marketing for Tech Startups', 'SEO, social media marketing, content strategy, and growth hacking for technology businesses.', 3, '2025-06-10', '2025-06-10', '15:00:00', 'Business Hall', 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800', 50, 'upcoming'),
('Robotics & Automation Workshop', 'Build and program robots. Learn about automation, sensors, and real-world robotics applications.', 1, '2025-06-15', '2025-06-17', '09:00:00', 'Robotics Lab', 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800', 25, 'upcoming');

-- ============================================
-- 3. NEWS (20 News Articles with Images)
-- ============================================
INSERT INTO news (title, description, image, status) VALUES
('DIU CIS Club Launches New Web Portal', 'We are thrilled to announce the launch of our brand new web portal designed to enhance communication, event management, and member engagement. The portal features real-time event updates, online registration, and a comprehensive dashboard for members.', 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800', 'published'),
('Programming Contest Winners Announced', 'Congratulations to Team CodeMasters for winning the Annual Programming Contest 2024! They solved 8 out of 10 problems in record time. First prize: BDT 30,000. Second place went to Team ByteChampions, and third to Team AlgoExperts.', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800', 'published'),
('AI Workshop Success: 150+ Participants', 'Our recent Artificial Intelligence workshop was a massive success with over 150 students participating. Industry experts from Google and Microsoft shared insights on machine learning, neural networks, and the future of AI technology.', 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800', 'published'),
('New Partnership with Microsoft', 'DIU CIS Club proudly announces a strategic partnership with Microsoft Bangladesh. Members will receive free access to Azure credits, Microsoft Learn resources, and exclusive workshop opportunities with Microsoft certified trainers.', 'https://images.unsplash.com/photo-1633409361618-c73427e4e206?w=800', 'published'),
('Hackathon 2024 Highlights', 'Our 48-hour hackathon brought together 200+ developers creating innovative solutions. Winning project "HealthConnect" developed a telemedicine platform. Prize pool exceeded BDT 100,000 with support from local tech companies.', 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800', 'published'),
('Career Fair: 500+ Job Offers', 'Record-breaking Career Fair 2024 hosted 35 tech companies including bKash, Pathao, and Grameenphone. Over 500 job offers were made on-spot. Students received valuable career counseling and interview preparation tips.', 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800', 'published'),
('Cybersecurity Awareness Campaign', 'CIS Club launches month-long cybersecurity awareness campaign. Free workshops on password security, phishing prevention, and safe internet practices. Special session on protecting personal data in the digital age.', 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800', 'published'),
('Alumni Meetup: Inspiring Success Stories', 'Alumni from Google, Amazon, and Microsoft shared their journey from DIU to global tech giants. Over 300 students attended. Key topics: interview preparation, career growth, and the importance of continuous learning.', 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800', 'published'),
('Mobile App Development Workshop', 'Three-day intensive workshop on Flutter and React Native concluded successfully. Participants built and deployed 5 fully functional mobile applications. Workshop materials and code available on our GitHub repository.', 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800', 'published'),
('Tech Talk: Future of Web Development', 'Industry experts discussed emerging trends: Web3, Progressive Web Apps, and serverless architecture. Live coding demonstrations of Next.js and modern JavaScript frameworks. Session recording available for members.', 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800', 'published'),
('Research Paper Published in IEEE', 'Proud moment! Our club members published research on "Machine Learning in Healthcare" in IEEE conference proceedings. This achievement highlights the quality of research happening at DIU CIS Club.', 'https://images.unsplash.com/photo-1532619675605-1ede6c2ed2b0?w=800', 'published'),
('New Lab Facilities Inaugurated', 'State-of-the-art computer lab with 50 high-performance workstations, VR equipment, and IoT devices inaugurated. Lab equipped for AI, game development, and robotics projects. Available for all club members.', 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800', 'published'),
('Student Startup Wins National Award', 'Club member startup "TechSolve" won Best Student Startup Award at BASIS SoftExpo 2024. Their EdTech platform now serves 10,000+ students. Proof that innovation starts here at DIU CIS Club!', 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=800', 'published'),
('Blockchain Workshop Announcement', 'Upcoming workshop on Blockchain technology, smart contracts, and cryptocurrency. Learn to build decentralized applications (DApps). Limited seats. Registration opens next Monday.', 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800', 'published'),
('Women in Tech Initiative Launch', 'New initiative to encourage female students in technology. Mentorship program, scholarship opportunities, and special workshops. Featuring successful women tech leaders as mentors and speakers.', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800', 'published'),
('Open Source Contribution Drive', 'Join our open source contribution program. Contribute to real-world projects, improve your GitHub profile, and learn collaborative coding. Special recognition for top contributors.', 'https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=800', 'published'),
('Tech Quiz Competition Results', 'Monthly tech quiz competition concluded with record participation. Top scorer: Fahim Ahmed with perfect 50/50. Quiz covered programming, algorithms, current tech trends, and computer science fundamentals.', 'https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?w=800', 'published'),
('Industry Visit: bKash Head Office', 'Exciting industry visit to bKash headquarters. Members learned about fintech operations, digital payment systems, and agile development practices. Q&A session with senior engineers and product managers.', 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800', 'published'),
('Annual General Meeting 2025', 'Successfully conducted AGM with 200+ members attending. New executive committee elected. Reviewed past year achievements and unveiled exciting plans for 2025 including international collaborations.', 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800', 'published'),
('Coding Bootcamp Registration Open', 'Summer coding bootcamp registration now open! Intensive 8-week program covering full-stack development, data structures, algorithms, and system design. Early bird discount available.', 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800', 'published');

-- ============================================
-- 4. COMMITTEE MEMBERS (15 Members with Photos)
-- ============================================
INSERT INTO committee_members (full_name, position, image, email, facebook, linkedin, phone, display_order, status) VALUES
('Md. Ariful Islam', 'President', 'https://randomuser.me/api/portraits/men/1.jpg', 'ariful.islam@diu.edu.bd', 'https://facebook.com/ariful.islam', 'https://linkedin.com/in/ariful-islam', '+880 1711-111111', 1, 'active'),
('Fatema Tuz Johora', 'Vice President', 'https://randomuser.me/api/portraits/women/2.jpg', 'fatema.johora@diu.edu.bd', 'https://facebook.com/fatema.johora', 'https://linkedin.com/in/fatema-johora', '+880 1711-111112', 2, 'active'),
('Md. Shahriar Kabir', 'General Secretary', 'https://randomuser.me/api/portraits/men/3.jpg', 'shahriar.kabir@diu.edu.bd', 'https://facebook.com/shahriar.kabir', 'https://linkedin.com/in/shahriar-kabir', '+880 1711-111113', 3, 'active'),
('Nusrat Jahan Mim', 'Treasurer', 'https://randomuser.me/api/portraits/women/4.jpg', 'nusrat.mim@diu.edu.bd', 'https://facebook.com/nusrat.mim', 'https://linkedin.com/in/nusrat-mim', '+880 1711-111114', 4, 'active'),
('Rakibul Hasan', 'Technical Lead', 'https://randomuser.me/api/portraits/men/5.jpg', 'rakibul.hasan@diu.edu.bd', 'https://facebook.com/rakibul.hasan', 'https://linkedin.com/in/rakibul-hasan', '+880 1711-111115', 5, 'active'),
('Tasnia Rahman', 'Event Coordinator', 'https://randomuser.me/api/portraits/women/6.jpg', 'tasnia.rahman@diu.edu.bd', 'https://facebook.com/tasnia.rahman', 'https://linkedin.com/in/tasnia-rahman', '+880 1711-111116', 6, 'active'),
('Md. Tanvir Ahmed', 'Workshop Coordinator', 'https://randomuser.me/api/portraits/men/7.jpg', 'tanvir.ahmed@diu.edu.bd', 'https://facebook.com/tanvir.ahmed', 'https://linkedin.com/in/tanvir-ahmed', '+880 1711-111117', 7, 'active'),
('Ayesha Siddika', 'Public Relations Officer', 'https://randomuser.me/api/portraits/women/8.jpg', 'ayesha.siddika@diu.edu.bd', 'https://facebook.com/ayesha.siddika', 'https://linkedin.com/in/ayesha-siddika', '+880 1711-111118', 8, 'active'),
('Mahmudul Hasan', 'Marketing Lead', 'https://randomuser.me/api/portraits/men/9.jpg', 'mahmudul.hasan@diu.edu.bd', 'https://facebook.com/mahmudul.hasan', 'https://linkedin.com/in/mahmudul-hasan', '+880 1711-111119', 9, 'active'),
('Farzana Akter', 'Content Creator', 'https://randomuser.me/api/portraits/women/10.jpg', 'farzana.akter@diu.edu.bd', 'https://facebook.com/farzana.akter', 'https://linkedin.com/in/farzana-akter', '+880 1711-111120', 10, 'active'),
('Imran Hossain', 'Web Developer', 'https://randomuser.me/api/portraits/men/11.jpg', 'imran.hossain@diu.edu.bd', 'https://facebook.com/imran.hossain', 'https://linkedin.com/in/imran-hossain', '+880 1711-111121', 11, 'active'),
('Sabrina Ahmed', 'Graphic Designer', 'https://randomuser.me/api/portraits/women/12.jpg', 'sabrina.ahmed@diu.edu.bd', 'https://facebook.com/sabrina.ahmed', 'https://linkedin.com/in/sabrina-ahmed', '+880 1711-111122', 12, 'active'),
('Asif Mahmud', 'Social Media Manager', 'https://randomuser.me/api/portraits/men/13.jpg', 'asif.mahmud@diu.edu.bd', 'https://facebook.com/asif.mahmud', 'https://linkedin.com/in/asif-mahmud', '+880 1711-111123', 13, 'active'),
('Tahmina Akter', 'Membership Secretary', 'https://randomuser.me/api/portraits/women/14.jpg', 'tahmina.akter@diu.edu.bd', 'https://facebook.com/tahmina.akter', 'https://linkedin.com/in/tahmina-akter', '+880 1711-111124', 14, 'active'),
('Nafis Rahman', 'Volunteer Coordinator', 'https://randomuser.me/api/portraits/men/15.jpg', 'nafis.rahman@diu.edu.bd', 'https://facebook.com/nafis.rahman', 'https://linkedin.com/in/nafis-rahman', '+880 1711-111125', 15, 'active');

-- ============================================
-- 5. SPONSORS (10 Sponsors with Logos)
-- ============================================
INSERT INTO sponsors (sponsor_name, logo, website, description, status) VALUES
('Microsoft Bangladesh', 'https://logo.clearbit.com/microsoft.com', 'https://www.microsoft.com/bn-bd', 'Global technology company providing cloud computing, software, and AI solutions.', 'active'),
('Google Developer Groups Dhaka', 'https://logo.clearbit.com/google.com', 'https://gdg.community.dev/dhaka', 'Supporting local developer communities with technology and resources.', 'active'),
('bKash Limited', 'https://logo.clearbit.com/bka.sh', 'https://www.bkash.com', 'Leading mobile financial service provider in Bangladesh.', 'active'),
('Pathao', 'https://logo.clearbit.com/pathao.com', 'https://www.pathao.com', 'Leading tech company offering ride-sharing, food delivery, and logistics.', 'active'),
('Daraz Bangladesh', 'https://logo.clearbit.com/daraz.com.bd', 'https://www.daraz.com.bd', 'Largest e-commerce platform in Bangladesh, part of Alibaba Group.', 'active'),
('Grameenphone', 'https://logo.clearbit.com/grameenphone.com', 'https://www.grameenphone.com', 'Leading telecommunications service provider in Bangladesh.', 'active'),
('Brain Station 23', 'https://logo.clearbit.com/brainstation-23.com', 'https://www.brainstation-23.com', 'Leading software and IT services company in Bangladesh.', 'active'),
('Samsung Bangladesh', 'https://logo.clearbit.com/samsung.com', 'https://www.samsung.com/bd', 'Global electronics company and technology partner.', 'active'),
('GitHub', 'https://logo.clearbit.com/github.com', 'https://github.com', 'World\'s leading software development platform and code repository.', 'active'),
('JetBrains', 'https://logo.clearbit.com/jetbrains.com', 'https://www.jetbrains.com', 'Provider of professional development tools for developers.', 'active');

-- ============================================
-- SUCCESS MESSAGE
-- ============================================
SELECT 'Demo data inserted successfully!' AS Status,
       (SELECT COUNT(*) FROM users WHERE status='active') AS Active_Users,
       (SELECT COUNT(*) FROM events) AS Total_Events,
       (SELECT COUNT(*) FROM news) AS Total_News,
       (SELECT COUNT(*) FROM committee_members) AS Committee_Members,
       (SELECT COUNT(*) FROM sponsors) AS Total_Sponsors;
