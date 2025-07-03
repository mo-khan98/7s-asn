import { render, screen, fireEvent } from '@testing-library/react';
import { ShiftList } from '../ShiftList';

jest.mock('../../services/shiftService', () => ({
  shiftService: {
    getAllShifts: jest.fn().mockResolvedValue([
      { id: 1, day: '2025-07-03', start_time: '09:00:00', end_time: '17:00:00', role: 'server', created_at: '', updated_at: '' },
    ]),
    getAllAssignments: jest.fn().mockResolvedValue([
      { id: 1, shift_id: 1, staff_id: 2, assigned_at: '', staff_name: 'Test', shift_day: '2025-07-03', shift_start_time: '09:00:00', shift_end_time: '17:00:00', shift_role: 'server' },
    ]),
  },
}));

describe('ShiftList', () => {
  it('renders with shifts and assigned staff', async () => {
    render(<ShiftList />);
    expect(await screen.findByText(/Shifts/i)).toBeInTheDocument();
    expect(await screen.findByText(/Test/i)).toBeInTheDocument();
  });

  it('opens AssignShiftModal when Assign button is clicked', async () => {
    render(<ShiftList />);
    const assignButton = await screen.findByRole('button', { name: /Assign|Reassign/i });
    fireEvent.click(assignButton);
    expect(await screen.findByRole('heading', { name: /Assign Shift/i })).toBeInTheDocument();
  });
}); 