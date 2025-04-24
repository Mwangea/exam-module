# Exam Module - Laravel Assessment

## Overview
A complete exam module built with Laravel that allows users to take multiple-choice exams and view their results. This implementation meets all requirements from the Laravel Developer Assessment while including several bonus features.

## Features

### Core Features
- **Exam Dashboard**
  - View all available exams
  - See exam details (title, category, duration, question count)
  - Start exams with a single click

- **Exam Interface**
  - Answer multiple-choice questions
  - Visual progress tracking
  - Timer to track remaining time
  - Save progress functionality

- **Results Page**
  - View overall score percentage
  - Detailed breakdown of correct/incorrect answers
  - Review questions with correct answers
  - Print results option

### Bonus Features
- Category filtering on dashboard
- Session-based answer storage
- Professional UI with Tailwind CSS
- Interactive elements with JavaScript
- Responsive design for all devices

## Technical Stack
- **Backend**: Laravel 10
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL (via Laravel migrations)
- **JavaScript**: Vanilla JS for interactive elements

## Installation

### Prerequisites
- PHP 8.1+
- Composer
- Node.js 16+
- MySQL 5.7+

### Setup Instructions
1. Clone the repository:
```bash
git clone https://github.com/mwangea/exam-module.git
cd exam-module
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create and configure environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exam_module
DB_USERNAME=root
DB_PASSWORD=
```

7. Run migrations and seeders:
```bash
php artisan migrate --seed
```

8. Build assets:
```bash
npm run build
```

9. Start the development server:
```bash
php artisan serve
```
The application will be available at http://localhost:8000

10. Run vite server also:
    ```bash
    npm run dev
    ```
The server will be available at http://localhost:5173

## Database Structure

### Tables
- **exams**
  - id (primary key)
  - title (string)
  - category (string)
  - duration (integer, minutes)
  - description (text)
  - created_at (timestamp)
  - updated_at (timestamp)

- **questions**
  - id (primary key)
  - exam_id (foreign key)
  - question_text (text)
  - explanation (text, nullable)
  - created_at (timestamp)
  - updated_at (timestamp)

- **answers**
  - id (primary key)
  - question_id (foreign key)
  - answer_text (text)
  - is_correct (boolean)
  - created_at (timestamp)
  - updated_at (timestamp)

### Relationships
- An Exam has many Questions
- A Question belongs to an Exam
- A Question has many Answers
- An Answer belongs to a Question

## Seeded Data
The database seeder creates:
- 2 sample exams (Mathematics and Science)
- 5-10 questions per exam
- 4 answers per question (1 correct, 3 incorrect)

Sample exam questions cover topics like:
- Basic arithmetic
- Algebraic equations
- Planetary science
- Chemical elements

## Application Flow
1. **Dashboard (/)**
   - Lists all available exams
   - Filter exams by category
   - Click "Start Exam" to begin

2. **Exam Interface (/exams/{exam})**
   - View and answer questions
   - Timer shows remaining time
   - Progress bar tracks completion
   - Save progress or submit when finished

3. **Results Page**
   - View overall score percentage
   - See correct/incorrect breakdown
   - Review questions with explanations
   - Option to print results

## Code Structure

### Controllers
- `ExamController.php`: Handles exam listing and filtering
- `ExamAttemptController.php`: Manages exam taking and submission

### Models
- `Exam.php`: Exam model with relationships
- `Question.php`: Question model with relationships
- `Answer.php`: Answer model with relationships

### Views
- `layouts/app.blade.php`: Main application layout
- `exams/index.blade.php`: Exam dashboard
- `exams/attempt.blade.php`: Exam interface
- `exams/result.blade.php`: Results page

### Routes
```php
Route::get('/', [ExamController::class, 'index'])->name('exams.index');
Route::get('/exams/{exam}', [ExamAttemptController::class, 'show'])->name('exams.attempt');
Route::post('/exams/{exam}', [ExamAttemptController::class, 'store'])->name('exams.submit');
```

## Testing the Application
1. Access the dashboard at http://localhost:8000
2. Select an exam to begin
3. Answer all questions (or save progress)
4. Submit the exam
5. Review your results

## Screenshots
- **Exam Dashboard**
  - Exam dashboard showing available tests
![image](https://github.com/user-attachments/assets/82a4a5e5-ae82-4f77-a6da-72bd02fe8dd6)

- **Exam Interface**
  - Exam interface with progress tracking
![image](https://github.com/user-attachments/assets/8af02061-da54-484a-9320-381333f5d8ba)
![image](https://github.com/user-attachments/assets/b08f982f-f6ae-4ba6-afd6-6b3012320824)


- **Results Page**
  - Detailed results with score breakdown
    ![image](https://github.com/user-attachments/assets/92bec4a8-c918-4bcd-8fd1-df9837292b9e)
    ![image](https://github.com/user-attachments/assets/dc6d82da-f530-4baf-9fe2-59cb14364c34)



## Deployment
For production deployment:
1. Configure proper database settings in `.env`
2. Set `APP_ENV=production`
3. Run:
```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## License
MIT License

## Support
For any issues or questions, please contact 
