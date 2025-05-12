<?php

// MarkdownView.php (View)
require_once 'ViewInterface.php';

class MarkdownView implements ViewInterface {
    public function render(array $data): string {
        $output = "# Информация о пользователе <br><br>";

        foreach ($data as $user) {
            if ($user instanceof User) {
                $output .= "## " . $user->getName() . "<br><br>";
                $output .= "* **Роль:** " . $user->getRole() . "<br>";
                $output .= "* **Email:** " . $user->getEmail() . "<br><br>";
            }
        }

        return $output;
    }
}
