import { render, screen } from '@testing-library/react';
import { AssignShiftModal } from '../AssignShiftModal';

jest.mock('../../services/staffService', () => ({
  staffService: {
    getAllStaff: jest.fn().mockResolvedValue([
      { id: 1, name: 'Test1', role: 'server', phone: '123', email: '', created_at: '', updated_at: '' },
      { id: 2, name: 'Test2', role: 'cook', phone: '456', email: '', created_at: '', updated_at: '' },
    ]),
  },
}));
jest.mock('../../services/shiftService', () => ({
  shiftService: {
    assignShift: jest.fn().mockResolvedValue({ id: 1 }),
  },
}));

describe('AssignShiftModal', () => {
  it('renders modal title and shift details', () => {
    render(
      <AssignShiftModal
        isOpen={true}
        onClose={() => {}}
        shiftId={1}
        shiftRole="server"
        shiftDay="2025-07-03"
        shiftTime="09:00 - 17:00"
        onAssigned={() => {}}
      />
    );
    expect(screen.getByRole('heading', { name: /Assign Shift/i })).toBeInTheDocument();
    expect(screen.getByText(/2025-07-03/i)).toBeInTheDocument();
    expect(screen.getByText(/09:00 - 17:00/i)).toBeInTheDocument();
    expect(screen.getByText(/server/i)).toBeInTheDocument();
  });

  it('Assign button is disabled until staff is selected', () => {
    render(
      <AssignShiftModal
        isOpen={true}
        onClose={() => {}}
        shiftId={1}
        shiftRole="server"
        shiftDay="2025-07-03"
        shiftTime="09:00 - 17:00"
        onAssigned={() => {}}
      />
    );
    expect(screen.getByRole('button', { name: /Assign Shift/i })).toBeDisabled();
  });
}); 