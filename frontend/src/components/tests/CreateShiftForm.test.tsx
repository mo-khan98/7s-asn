import { render, screen } from '@testing-library/react';
import { CreateShiftForm } from '../CreateShiftForm';
 
test('renders CreateShiftForm', () => {
  render(<CreateShiftForm onShiftCreated={() => {}} />);
  expect(screen.getByText(/Create New Shift/i)).toBeInTheDocument();
}); 