<?php

function build(&$a) {
    if (!array_key_exists('assignment', $a['request'])) {
        unset($a['question_num']);
        \Edu8\Http::redirect('/');
    }

    $a['alpha'] = ['Z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
    $a['assignment'] = $a['request']['assignment'];
    $connection = \Edu8\Config::initDb();

    if (!array_key_exists('question_num', $a)) {
        $completed_statement = \Edu8\Sql::runStatement($connection, 'completed', ['student' => $a['student']['student_'], 'assignment' => $a['assignment']]);
        $q_completed = $completed_statement->fetchAll();

        $question_statement = \Edu8\Sql::runStatement($connection, 'assignment_question', ['assignment' => $a['assignment']]);
        $a['question'] = $question_statement->fetchAll();

        /* foreach ($a['question'] as &$q) {
          $q['concepts'] = preg_split('/,/', $q['concepts']);
          } */

        $a['concepts'] = [
            'Amplitude',
            'Angular acceleration',
            'Angular frequency',
            'Angular velocity',
            'Area',
            'Area/integral',
            'Center of Mass',
            'Conservation of Mechanical Energy',
            ['Conservation of Momentum', ['Conservation of Momentum in Horizontal Direction', 'Conservation of Momentum in Vertical Direction']],
            'Constant acceleration',
            'Constant speed',
            'Constant velocity',
            'Curvature',
            'Diffraction',
            'Direction',
            'Displacement',
            'Doppler Effect',
            'Doppler effect',
            'Elastic Potential Energy',
            'Energy levels',
            'Energy of each photon',
            'Energy of emitted photon',
            'Free fall',
            'Freefall',
            'Frequency',
            'Frequency of each photon',
            'Friction',
            'Gravitational Potential Energy',
            'Harmonics',
            'History Graph',
            'Hooke\'s Law',
            'Hookes Law',
            'Huygens Principle',
            'Impulse',
            'Index of refraction',
            'Inertia',
            'Initial Conditions',
            'Initial conditions',
            'Interference',
            'KE of ejected electrons',
            'Kinetic Energy',
            'Mass',
            ['Newton\'s laws', ['Newton\'s 1st Law', 'Newton\'s 2nd Law', 'Newton\'s 3rd Law']],
            'Non-zero acceleration',
            'Normal Force/ Contact',
            'Number of photons',
            'Origin',
            'Path length difference',
            'Phase',
            'Phase Angle',
            'Prisms',
            'Projectile motion',
            'Propagation Velocity',
            'Quantization',
            'Radial acceleration',
            'Ray Model of Light',
            'Rayleigh Criterion',
            'Reflection',
            'Refraction',
            'Restoring Constant',
            'Restoring Force',
            'Restoring force',
            'Rotational Kinematics',
            'Sanpshot Graph',
            'Slope',
            'Slope/Derivative',
            'Small angle approximation',
            'Speeding-up or slowing-down',
            'Spring Constant',
            'Standing wave',
            'Stopping potential',
            'Tension',
            'Tangential acceleration',
            'Transverse Acceleration',
            'Transverse Velocity',
            'Traveling wave',
            'Vector difference',
            'Velocity',
            'Wave Model of light',
            'Wavelength',
            'Wavelength & Color',
            'Wavelength of each photon',
            'Weight',
            'Work',
            'Work function',
            'Zero acceleration / equilibrium'
        ];

        $a['question_num'] = $q_completed[0]['q_completed'] >> 1;   // div by 2 | note: >> will have no effect if 0.

        if (count($a['question']) <= $a['question_num']) {
            unset($a['question_num']);
            \Edu8\Http::redirect('/');
        }
    }
}

?>
