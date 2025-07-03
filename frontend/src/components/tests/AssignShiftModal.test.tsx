import { render, screen } from '@testing-library/react';
import { AssignShiftModal } from '../AssignShiftModal';

describe('AssignShiftModal', () => {
  it('renders modal title', () => {
    render(
      <AssignShiftModal
        isOpen={true}
        onClose={() => {}}
        shiftId={1}
        shiftRole="server"
        shiftDay="2024-01-15"
        shiftTime="09:00 - 17:00"
        onAssigned={() => {}}
      />
    );
    expect(screen.getByRole('heading', { name: /Assign Shift/i })).toBeInTheDocument();
  });
}); 