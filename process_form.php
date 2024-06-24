<?php

/**
 * FormProcessor Class
 * 
 * This class handles form data processing and validation.
 */
class FormProcessor
{
    /**
     * Process the form data.
     *
     * @param array $data The form data.
     * @return array The result of the processing.
     */
    public function processForm(array $data): array
    {
        // Validate the form data
        $validationResult = $this->validateFormData($data);
        if ($validationResult['success'] === false) {
            return $validationResult;
        }

        // If validation passes, return success message
        return [
            'success' => true,
            'message' => 'Form submitted successfully!'
        ];
    }

    /**
     * Validate the form data.
     *
     * @param array $data The form data.
     * @return array The result of the validation.
     */
    private function validateFormData(array $data): array
    {
        // Check if all fields are filled
        if (empty($data['name']) || empty($data['email']) || empty($data['message'])) {
            return [
                'success' => false,
                'message' => 'All fields are required.'
            ];
        }

        // Validate the email address
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'message' => 'Invalid email address.'
            ];
        }

        return ['success' => true];
    }
}

// Include necessary headers for JSON response
header('Content-Type: application/json');

try {
    // Instantiate the FormProcessor class
    $formProcessor = new FormProcessor();

    // Get the form data from the POST request
    $formData = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'message' => $_POST['message'] ?? ''
    ];

    // Process the form data
    $result = $formProcessor->processForm($formData);

    // Return the result as JSON
    echo json_encode($result);
} catch (Exception $e) {
    // Handle any exceptions
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred: ' . $e->getMessage()
    ]);
}

