import { render, screen, fireEvent } from '@testing-library/react';
import { CreateShiftForm } from '../CreateShiftForm';

jest.mock('../../services/shiftService', () => ({
  shiftService: {
    createShift: jest.fn().mockResolvedValue({ id: 1 }),
  },
}));

describe('CreateShiftForm', () => {
  it('renders all form fields and button', () => {
    render(<CreateShiftForm onShiftCreated={() => {}} />);
    expect(screen.getByLabelText(/Date/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/Start Time/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/End Time/i)).toBeInTheDocument();
    expect(screen.getByText(/Role/i)).toBeInTheDocument();
    expect(screen.getByRole('button', { name: /Create Shift/i })).toBeInTheDocument();
  });

  it('updates input values when typing', () => {
    render(<CreateShiftForm onShiftCreated={() => {}} />);
    const dateInput = screen.getByLabelText(/Date/i);
    fireEvent.change(dateInput, { target: { value: '2025-07-03' } });
    expect(dateInput).toHaveValue('2025-07-03');
  });

  it('calls onShiftCreated after submit', async () => {
    const mockOnShiftCreated = jest.fn();
    render(<CreateShiftForm onShiftCreated={mockOnShiftCreated} />);
    fireEvent.change(screen.getByLabelText(/Date/i), { target: { value: '2025-07-03' } });
    fireEvent.change(screen.getByLabelText(/Start Time/i), { target: { value: '09:00' } });
    fireEvent.change(screen.getByLabelText(/End Time/i), { target: { value: '17:00' } });

    // selecting the role
    fireEvent.mouseDown(screen.getByText(/Role/i).parentElement!.querySelector('[data-slot="select-trigger"]')!);
    const options = screen.getAllByText('Server');
    fireEvent.click(options[options.length - 1]);
    fireEvent.click(screen.getByRole('button', { name: /Create Shift/i }));
    await screen.findByRole('button', { name: /Create Shift/i });
    expect(mockOnShiftCreated).toHaveBeenCalled();
  });
}); 